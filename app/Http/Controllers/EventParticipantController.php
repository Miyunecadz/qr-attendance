<?php

namespace App\Http\Controllers;

use App\Models\EventParticipant;
use App\Models\Faculty;
use Illuminate\Http\Request;

class EventParticipantController extends Controller
{
    public function index()
    {
        $participants = [];
        return view('events.participants.index', compact('participants'));
    }

    public function destroy(Request $request)
    {
        dd($request->all());
    }
}
