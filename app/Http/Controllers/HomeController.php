<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    // gives the home view
    public function index()
    {
        return view('home');
    }
}
