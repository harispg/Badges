<?php

namespace App\Http\Controllers;

use App\Photo;
use App\Badge;
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

    public function deletePhoto(Request $request){
        if(Gate::allows('create-badges')){
            $photo = Photo::find($request->photo);
            $badgeId = $photo->badge->id;
            if($lastPicture = $photo->deletePhotoAndFile());
            $badge = Badge::find($badgeId);
            $remainingPhotos = $badge->photos;
            return response()->json([$remainingPhotos, $lastPicture]);
        }
        return abort(403, 'You have no permission to change Badges');
    }

    public function like(Request $request){
            $photo = Photo::find($request->photo);
            $photo->users()->attach(auth()->user());
           return response()->json($photo);
    }

    public function unLike(Request $request){
            $photo = Photo::find($request->photo);
            $photo->users()->detach(auth()->user());
           return response()->json($photo);
    }
}