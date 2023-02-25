<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventParticipant;
use App\Models\Student;
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

        if(! auth()->user()->isAdmin()){

            $eventAttendedCount = EventParticipant::where('is_present', true)->count();
            $eventAbsentCount = EventParticipant::where('is_present', false)->count();
            $upcomingEvents = Event::whereDate('date', '>=', now()->format('Y-m-d'))->get();
        } 
        if(auth()->user()->isAdmin()){

            $numberOfEvents = Event::count();
            $numberOfUsers = EventParticipant::where('user_type', '!=', '1')->count();
            $upcomingEvents = Event::whereDate('date','>=', now()->format('Y-m-d'))->get();
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
