<?php

namespace App\Http\Controllers;

use App\Models\Faculty;
use App\Models\Student;
use Illuminate\Http\Request;
use App\Models\EventParticipant;
use Illuminate\Support\Facades\DB;

class EventParticipantController extends Controller
{
    public function index($event_id)
    {
        $participants = EventParticipant::where('event_id', $event_id)->get();

        return view('events.participants.index', compact('participants'));
    }

    public function create()
    {
        $participants = EventParticipant::where('event_id', request()->event)->get();
        $faculties = Faculty::select([
            'id',
            'employee_id as id_number',
            'name',
            'department',
            DB::raw('(CASE WHEN faculties.id > 0 THEN 3 END) as user_type')
        ])->whereNotIn('id', $participants->where('user_type', 3)->pluck('user_id')->all());

        $students = Student::select([
            'id',
            'id_number',
            'name',
            'department',
            DB::raw('(CASE WHEN students.id > 0 THEN 2 END) as user_type')
        ])
        ->union($faculties)
        ->get()
        ->whereNotIn('id', $participants->where('user_type', 2  )->pluck('user_id')->all());

        $participants = $students;
        return view('events.participants.create', compact('participants'));
    }

    public function store(Request $request)
    {

        $participants = $request->input('participants');
        if (!is_array($participants) || count($participants) < 1) {
            return redirect()->back()->withErrors(['participants' => 'Must select at least one participant.']);
        }

        foreach ($participants as $participant) {
            $data = explode('-', $participant);
            $user_id = $data[0];
            $user_type = $data[1];

            $eventParticipant = new EventParticipant;
            $eventParticipant->event_id = $request->event;
            $eventParticipant->user_id = $user_id;
            $eventParticipant->user_type = $user_type;
            $eventParticipant->save();
        }
        return redirect()->route('events.participants.index', $request->event)->with('success', 'Successfully added participants.');
    }

    public function destroy(Request $request)
    {
        $participantIds = $request->input('participants');
        if (!$participantIds || count($participantIds) < 1) {
            return redirect()->back()->with('error', 'Select at least one participant ID is required.');
        }

        EventParticipant::whereIn('id', $participantIds)->delete();

        return redirect()->back()->with('success', 'Participants have been successfully deleted.');
    }
}
