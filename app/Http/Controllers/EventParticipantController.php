<?php

namespace App\Http\Controllers;

use App\Models\EventParticipant;
use App\Models\Faculty;
use Illuminate\Http\Request;

class EventParticipantController extends Controller
{
    public function index($event_id)
    {
        $participants = EventParticipant::where('event_id', $event_id)->get();

        return view('events.participants.index', compact('participants'));
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
