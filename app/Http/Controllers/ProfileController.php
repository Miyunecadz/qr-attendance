<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use App\Models\Admin;
use App\Models\Student;
use App\Models\Faculty;

class ProfileController extends Controller
{
    public function show()
    {
        return view('auth.profile');
    }

    public function update(Request $request)
    {
        $user = [];
        if(auth()->user()->account_type == 1) {
           $user = Admin::find(user()->user_id);
            $user = Admins::where('account_type', 1)->where('user_id', user()->user_id)->first();
            $user->update ([
                'name' => $request->name,

                
                
            ]);
            
        } elseif(auth()->user()->account_type == 2) {
            $user = Student::find(user()->user_id);
            $user = Students::where('account_type', 2)->where('user_id', user()->user_id)->first();
            $user->update ([
                'name' => $request->name,
                'department' => Str::upper($request->department),
                'year_level' => $request->year_level,
                'section' => $request->section,
                'contact_number' => $request->contact_number,
                'email' => $request->email,

               
            ]);
        } elseif(auth()->user()->account_type == 3) 
        {
           $user = Faculty::find(auth()->user()->user_id);
            $user = Faculties::where('account_type', 3)->where('user_id', user()->user_id)->first();
            $user->update ([
                'name' => $request->name,
                'department' => Str::upper($request->department),
                'position' => $request->position,
                'contact_number' => $request->contact_number,
                'email' => $request->email,

                
            ]);
        }
        
        $user->update($request->all());
        return back()->with('success', 'Successfully updated profile information');
       
    }
}
