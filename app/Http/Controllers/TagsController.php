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

    public function connect(Request $request, Badge $badge){
    	$newTagsNames = array_map('strtolower',explode(',',$request->tags));
    	$allTagsNames = Tag::all()->pluck('name')->toArray();
    	$existingTagNames = array_values(
    		array_intersect(
    			array_map('strtolower',$allTagsNames), 
    			array_map('strtolower',$newTagsNames)
    		)
    	);

    	$tagIDs = [];
    	foreach($existingTagNames as $name){
    		$tagIDs[] = Tag::where('name',$name)->first()->id;
    	}
    	dd(array_diff($newTagsNames, $existingTagNames));
    }

    public function store($tag){
    	$this->validate($tag,[
    		'name' => 'required|unique:tags,name'
    	]);
    }
}
