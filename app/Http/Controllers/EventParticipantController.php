<?php

namespace App\Http\Controllers;

use App\Models\EventParticipant;
use App\Models\Faculty;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EventParticipantController extends Controller
{
    public function index()
    {
        $participants = [];
        return view('events.participants.index', compact('participants'));
    }

    public function create()
    {
        $participants = [];
        return view('events.participants.create', compact('participants'));
    }

    public function store(Request $request)
    {
        dd($request->all());
    }

    public function destroy(Request $request)
    {
        dd($request->all());
    }
}
