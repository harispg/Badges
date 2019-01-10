<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tag;
use App\Badge;

class TagsController extends Controller
{
    public function index(Request $request, Tag $tag){
    	$badges = $tag->badges()->latest()->paginate(8);
    	return view('home', compact('badges'));
    }

    public function store(Request $request, Badge $badge){

        $badge->updateAndCreateTags($request->tags);

        return redirect()->route('showBadge', ['badge'=>$badge]);
    }

}
