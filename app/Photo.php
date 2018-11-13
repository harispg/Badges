<?php

namespace App;

use Image;
use App\User;
use App\Badge;
use Iluminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
	protected $baseDir = 'Images/Badges';

    protected $fillable=['name', 'path', 'thumbnail_path', 'badge_id', 'main_picture'];

    public function badge(){	
    	return $this->belongsTo(Badge::class);
    }

    public function users(){
        return $this->belongsToMany(User::class);
    }

    public function makePhotoFromFile($file){

    	$this->name=time() . $file->getClientOriginalName();
        $this->path = $this->baseDir . '/' . $this->name;
        $this->thumbnail_path = $this->baseDir . '/tn-' . $this->name;
        $file->move($this->baseDir, $this->name);

    	Image::make($this->path)->fit(200)->save($this->thumbnail_path);

    	return $this;

    }

    /* In If condition finds current Avatar(main_picture). 
       Than removes the main_picture attribute from it and saves new one*/

    public function setAsMain(){

        if($oldMain = $this->badge->photos->where('main_picture', true)->first()){
            $oldMain->main_picture = false;
            $oldMain->save();
        }
        $this->main_picture = true;
        $this->save();

    }
    

    /* Deleting photo and removing files*/

    public function deletePhotoAndFile(){
        if(count($this->badge->photos) != 1){    
            if($this->main_picture){
                $newMainPhoto = $this->badge->photos->where('main_picture', false)->first();
                if($newMainPhoto != null){
                    $newMainPhoto->setAsMain();
                    $newMainPhoto->save();
                }
            }

            File::delete([$this->path, $this->thumbnail_path]);

            $this->delete();

            return true;
        }
        return false;
    }

    public function isLiked($user){
        if($this->users()->find($user) === null){
            return false;
        }
        return true;
    }

}
