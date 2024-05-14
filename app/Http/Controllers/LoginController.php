<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'email' => ['required', 'email', 'exists:customers'],
            'password' => ['required'],
        ]);

        auth()->attempt(['email' => $validated['email'], 'password' => $validated['password']], true);
        return redirect()->route('products.index')->with(['message' => 'You successfully logged in.']);
    }

    public function logout()
    {
        auth()->logout();
        return redirect()->route('products.index');
    }
}
