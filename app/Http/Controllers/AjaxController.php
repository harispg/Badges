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
        $this->validate($request,[
            'photo' => 'numeric'
        ]);
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
            $length = count($remainingPhotos);
            for ($i=0; $i < $length; $i++) { 
                $remainingPhotos[$i] = 
                [$remainingPhotos[$i],$remainingPhotos[$i]->isLiked(auth()->id())];
            }
            return response()->json([$remainingPhotos, $lastPicture]);
        }
        return abort(403, 'You have no permission to change Badges');
    }

    public function like(Request $request){

            if(strpos($request->modelId, 'photo')== 0){
                $photo = Photo::find(str_replace("photo", "", $request->modelId));
                $photo->users()->attach(auth()->user());
                return response()->json($photo);
            }else{
                $badge = Badge::find(str_replace("badge", "", $request->modelId));
                $badge->users()->attach(auth()->user());
                return response()->json($badge);
            }

    }

    public function unLike(Request $request){
           if(strpos($request->modelId, 'photo')== 0){
                $photo = Photo::find(str_replace("photo", "", $request->modelId));
                $photo->users()->detach(auth()->user());
                return response()->json($photo);
            }else{
                $badge = Badge::find(str_replace("badge", "", $request->modelId));
                $badge->users()->detach(auth()->user());
                return response()->json($badge);
            }
    }
}