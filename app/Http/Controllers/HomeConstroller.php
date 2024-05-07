<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeConstroller extends Controller
{
    public function index()
    {
        return view('welcome');
    }
}
