<?php

namespace App\Http\Controllers;

use Image;
use App\Badge;
use App\Photo;
use Illuminate\Http\Request;



class PhotosController extends Controller
{
    public function store(Request $request, Badge $badge){
    	
    	$this->validate($request, [
    		'photo' => 'mimes:jpg,jpeg,bmp,png',
    	]);

    	$photo = (new Photo)->makePhotoFromFile($request->file('photo'));

        $badge->savePhoto($photo);

    	return 'done';
    }

    public function destroy(Photo $photo){

        $photo->deletePhotoAndFile();

    	return redirect()->back();
    }


}