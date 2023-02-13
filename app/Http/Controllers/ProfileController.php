<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\ProfileUpdateRequest;

class ProfileController extends Controller
{
    public function show()
    {
        return view('auth.profile');
    }

    public function update(Request $request)
    {
        
    }

    public function showPassword()
    {
        return view('users.password');
    }

    public function updatePassword(Request $request)
    {
        
    }
}
