<?php

namespace App\Http\Controllers;

use App\Photo;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    
    public function post(Request $request){

    	$response = array(
    		'status' => 'success',
    		'msg' => $request->message,
    	);

    	return response()->json($response);

    }

    public function photo(Request $request){

    	$photo = Photo::find($request->photo);
    	$photo->setAsMain();
    	$photo->save();

    	return response()->json($photo);

    }
}
