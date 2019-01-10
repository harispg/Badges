<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tag;

class TagsController extends Controller
{
    public function index(Request $request, Tag $tag){
    	$badges = $tag->badges()->latest()->paginate(8);
    	return view('home', compact('badges'));
    }
}
