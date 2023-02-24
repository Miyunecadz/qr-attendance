<?php

namespace App\Http\Controllers;

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

        return view('home', [
            'eventAttendedCount' => $eventAttendedCount,
            'eventAbsentCount' => $eventAbsentCount,
            'numberOfEvents' => $numberOfEvents,
            'numberOfUsers'  => $numberOfUsers,
            'upcomingEvents' => $upcomingEvents
        ]);
    }
}
