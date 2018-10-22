<?php

namespace App\Http\Controllers;

use App\Badge;
use App\Comment;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    public function store(Badge $badge, Request $request){
    	
    	$this->validate($request, [
    		'body' => 'required|min:8',
    	]);

    	$badge->addComment($request->body);

    	return redirect()->back();
    }
}
