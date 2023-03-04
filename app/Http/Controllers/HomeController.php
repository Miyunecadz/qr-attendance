<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventParticipant;
use App\Models\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $eventAttendedCount = 0;
        $eventAbsentCount = 0;
        $numberOfEvents = 0;
        $numberOfUsers = 0;
        $upcomingEvents = [];

        if (! auth()->user()->isAdmin()) {
            $user = auth()->user();
            $eventAttendedCount = EventParticipant::where('is_present', true)
            ->where('user_id', auth()->user()->user_id)
            ->where('user_type', auth()->user()->account_type)
            ->count();

            $eventAbsentCount = EventParticipant::where('is_present', false)
            ->where('user_id', auth()->user()->user_id)
            ->where('user_type', auth()->user()->account_type)
            ->count();

            $upcomingEvents = Event::join('event_participants', 'events.id', '=', 'event_participants.event_id')
            ->whereDate('date', '>=', now()->format('Y-m-d'))
            ->where('user_id', auth()->user()->user_id)
            ->where('user_type', auth()->user()->account_type)
            ->get();
        }
        if (auth()->user()->isAdmin()) {
            $numberOfEvents = Event::count();
            $numberOfUsers = User::where('account_type', '!=', '1')->count();
            $upcomingEvents = Event::whereDate('date', '>=', now()->format('Y-m-d'))->get();
        }

        return view('home', [
            'eventAttendedCount' => $eventAttendedCount,
            'eventAbsentCount' => $eventAbsentCount,
            'numberOfEvents' => $numberOfEvents,
            'numberOfUsers' => $numberOfUsers,
            'upcomingEvents' => $upcomingEvents,
        ]);
    }
}
