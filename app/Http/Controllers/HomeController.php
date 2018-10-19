<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Badge;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $badges = Badge::latest()->get();
        return view('home', compact('badges'));
    }
}
