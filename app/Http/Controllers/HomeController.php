<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Badge;
use Illuminate\Support\Facades\Route;

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

    public function test(){
        $route = Route::current();
        $name = Route::currentRouteName();
        $action = Route::currentRouteAction();

        return [$route];
     }
}
