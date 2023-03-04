<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventParticipant;
use App\Models\Faculty;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class ScanController extends Controller
{
    public function index()
    {
        return view('scan');
    }

    public function show($qrCode)
    {
        if (! $qrCode) {
            return response()->json([
                'status' => false,
            ]);
        }

        $decodedString = Crypt::decryptString($qrCode);
        $codes = explode('-', $decodedString);

        if (count($codes) != 2) {
            return response()->json([
                'status' => false,
            ]);
        }

        $user = collect();
        if ($codes[1] == '2') {
            $user = Student::select(['id_number', 'name'])->find($codes[0]);
        } else {
            $user = Faculty::select(['employee_id as id_number', 'name'])->find($codes[0]);
        }

        if (! $user) {
            return response()->json([
                'status' => false,
            ]);
        }

        $user['user_id'] = $codes[0];
        $user['user_type'] = $codes[1];

        return response()->json([
            'status' => true,
            'information' => $user,
        ]);
    }

    public function store(Request $request)
    {
        if (! $request->has('user_id') && ! $request->has('user_type')) {
            return back()->with('fail', 'Error when submitting information, Please try again!');
        }

        $participant = EventParticipant::where([
            'user_id' => $request->user_id,
            'user_type' => $request->user_type,
            'event_id' => $request->event,
        ])->first();

        if (! $participant) {
            return back()->with('fail', 'Participant was not included in the event');
        }

        $event = Event::find($request->event);

        $action = '';
        if (! $participant->time_in && $event->time_start <= now()->addHour()->format('H:i:s')) {
            $action = 'time in';
            $participant->update([
                'time_in' => now()->format('Y-m-d H:i:s'),
            ]);
        } elseif (! $participant->time_out && $event->time_end <= now()->addHour()->format('H:i:s')) {
            $action = 'time out';
            $participant->update([
                'time_out' => now()->format('Y-m-d H:i:s'),
                'is_present' => true,
            ]);
        } elseif ($participant->time_in && $participant->time_out) {
            return back()->with('fail', 'Participant has already logged in / logged out');
        } else {
            return back()->with('fail', 'Unable to proceed to the process, since participant failed to comply the given time of login / logout');
        }

        return back()->with('success', "Participant successfully $action");
    }
}
