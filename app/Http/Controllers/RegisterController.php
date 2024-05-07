<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'login' => ['required', 'min:3', 'alpha_dash', 'unique:users'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'confirmed', 'min:4'],
        ]);

        $user = new User([
            'login' => $validated['login'],
            'email' => $validated['email'],
            'password' => $validated['password'],
        ]);
        $user->save();

        auth()->attempt(['email' => $validated['email'], 'password' => $validated['password']]);
        
        return redirect()->back()->with(['message' => 'Ypu fuckein diud it bidghtk']);
    }
}
