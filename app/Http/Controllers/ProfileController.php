<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use App\Models\Admin;
use App\Models\Student;
use App\Models\Faculty;
use Illuminate\Support\Facades\Validator;

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
            $user = Admin::find(auth()->user()->user_id);
            $validator = Validator($request->all(),[
            
                'name' => 'required',
               
               
    
            ]);
            if ($validator->fails()) {
                return back()
                            ->withErrors($validator)
                            ->withInput();
            }
            $user->update ([
                
                
                'name' => $request->name,
               
            ]);
            return back()->with('success', 'Admin information successfully updated');
        }
        
        elseif(auth()->user()->account_type == 2) { 
            $user = Student::find(auth()->user()->user_id);
            $validator = Validator($request->all(),[
            
                'name' => 'required',
                'department' => 'required',
                'year_level' => 'required|numeric',
                'section' => 'required',
                'contact_number' => 'required|numeric',
                'email' => 'required|email',
               
               
    
            ]);
            if ($validator->fails()) {
                return back()
                            ->withErrors($validator)
                            ->withInput();
            }
            $user->update ([
                'name' => $request->name,
                'department' => $request->department,
                'year_level' => $request->year_level,
                'section' => $request->section,
                'contact_number' => $request->contact_number,
                'email' => $request->email,
               
            ]);
            return back()->with('success', 'Student information successfully updated');
        }
        elseif(auth()->user()->account_type == 3) { 
            $user = Faculty::find(auth()->user()->user_id);
            $validator = Validator($request->all(),[
            
                'name' => 'required',
                'department' => 'required',
                'position' => 'required',
                'contact_number' => 'required|numeric',
                'email' => 'required|email',
               
               
    
            ]);
            if ($validator->fails()) {
                return back()
                            ->withErrors($validator)
                            ->withInput();
            }
            $user->update ([
                'name' => $request->name,
                'department' => $request->department,
                'position' => $request->position,
                'contact_number' => $request->contact_number,
                'email' => $request->email,
               
            ]);
            return back()->with('success', 'Faculty information successfully updated');
        }
    }

    public function showPassword()
    {
        return view('users.password');
    }

    public function updatePassword(Request $request)
    {
        
    }
}
