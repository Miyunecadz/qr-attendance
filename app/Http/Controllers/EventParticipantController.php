<?php

namespace App\Http\Controllers;

use App\Models\EventParticipant;
use Illuminate\Http\Request;

class EventParticipantController extends Controller
{
    public function index($event_id)
    {
        $participants = EventParticipant::where('event_id', $event_id)->get();

        return view('events.participants.index', compact('participants'));
    }

    public function create()
    {
        $participants = [];

        return view('events.participants.create', compact('participants'));
    }

    public function store(Request $request)
    {
        $participants = $request->input('participants');

        if (count($participants) < 1) {
            return redirect()->back()->with('error', 'Must select at least one participant.')->withInput();
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

        if (count($participantIds) < 1) {
            return redirect()->back()->with('error', 'At least one participant ID is required.');
        }

        EventParticipant::whereIn('id', $participantIds)->delete();

        return redirect()->back()->with('success', 'Participants have been successfully deleted.');
    }
}
