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
        dd($request->all());
    }

    public function destroy(Request $request)
    {
        $participantIds = $request->input('participants');

        if (count($participantIds) < 1) {
            return redirect()->back()->with('error', 'At least one participant ID is required.');
        }

        EventParticipant::whereIn('id', $participantIds)->delete();

        return redirect()->back()->with('success', 'Participants have been successfully deleted.');
    }
}
