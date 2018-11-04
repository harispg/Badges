<?php

namespace App\Http\Controllers;

use App\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;


class AjaxController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    
    public function post(Request $request){

    	$response = array(
    		'status' => 'success',
    		'msg' => $request->message,
    	);

    	return response()->json($response);

    }


    public function changeAvatar(Request $request){
        if(Gate::allows('create-badges')){
        	$photo = Photo::find($request->photo);
        	$photo->setAsMain();
    	   return response()->json($photo);
        }
        return abort(403, 'You have no permission to change Badges');
    }
}