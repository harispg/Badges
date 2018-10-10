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

    	$this->makePhotoFromFile($request->file('photo'), $badge);

    	return 'done';
    }

    public function makePhotoFromFile($file, Badge $badge){
    	$name = time() . $file->getClientOriginalName();
    	$path = 'Images/Badges' . '/' . $name;
    	$thumbnail_path = 'Images/Badges' . '/tn-' . $name;
    	
    	$file->move('Images/Badges', $name);

    	Image::make($path)->fit(200)->save($thumbnail_path);

        $badge->savePhoto(new Photo([
            'name' => $name,
            'path' => $path, 
            'thumbnail_path' => $thumbnail_path
        ]));

    }


}