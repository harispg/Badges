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
            $lastPicture = $photo->deletePhotoAndFile();
            $badge = Badge::find($badgeId);
            $remainingPhotos = $badge->photos()->withCount(
                [
                    'users as liked' => function($query){
                        $query->where('id', auth()->id());
            }])->get()->toArray();
            
            return [$remainingPhotos, $lastPicture];
        }
        return abort(403, 'You have no permission to change Badges');
    }

    public function likeUnlike(Request $request){

            if(strpos($request->modelId, 'photo')!== false){
                $photo = Photo::find(str_replace("photo", "", $request->modelId));
                $photo->fresh()->users()->toggle([auth()->id()]);
                return response()->json($photo);
            }else{
                $badge = Badge::find(str_replace("badge", "", $request->modelId));
                $badge->fresh()->users()->toggle(auth()->user());
                return response()->json($badge);
            }

    }

    public function selected(Request $request){
        return Badge::find($request->badge)->name;
    }

    public function selectedBadges(Request $request){
        dd($request->all());
    }

    /*public function unLike(Request $request){
           if(strpos($request->modelId, 'photo')!== false){
                $photo = Photo::find(str_replace("photo", "", $request->modelId));
                $photo->users()->detach(auth()->user());
                return response()->json($photo);
            }else{
                $badge = Badge::find(str_replace("badge", "", $request->modelId));
                $badge->users()->detach(auth()->user());
                return response()->json($badge);
            }
    }*/
}