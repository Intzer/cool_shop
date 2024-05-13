<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function index()
    {
        return view('register');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'firstname' => ['required', 'min:3', 'alpha_dash'],
            'email' => ['required', 'email', 'unique:customers'],
            'password' => ['required', 'confirmed', 'min:4'],
        ]);

        $customer = new Customer([
            'firstname' => $validated['firstname'],
            'email' => $validated['email'],
            'password' => $validated['password'],
        ]);
        $customer->save();

        auth()->attempt(['email' => $validated['email'], 'password' => $validated['password']], true);

        return redirect()->route('products.index')->with(['message' => 'You successfully registered.']);
    }
}
