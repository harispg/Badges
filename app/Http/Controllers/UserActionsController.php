<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserActionsController extends Controller
{
    public function __construct()
    {
    	$this->middleware('superNintendo');
    }

    public function index(){
    	return view('admin.users');
    }
}
