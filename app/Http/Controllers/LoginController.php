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

        if (auth()->attempt(['email' => $validated['email'], 'password' => $validated['password']], true)) {
            return redirect()->route('products.index')->with(['message' => __('You successfully logged in.')]);
        } else {
            return redirect()->back()->withInput()->withErrors(['message' => __('Wrong login data.')]);
        }
    }

    public function logout()
    {
        auth()->logout();
        return redirect()->route('products.index')->with(['message' => __('You successfully logout.')]);
    }
}
