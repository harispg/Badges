<?php

namespace App;

use Image;
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

    public function makePhotoFromFile($file){

    	$this->name=time() . $file->getClientOriginalName();
        $this->path = $this->baseDir . '/' . $this->name;
        $this->thumbnail_path = $this->baseDir . '/tn-' . $this->name;
        $file->move($this->baseDir, $this->name);

    	Image::make($this->path)->fit(200)->save($this->thumbnail_path);

    	return $this;

    }

    public function setAsMain(){

        if($oldMain = $this->badge->photos->where('main_picture',true)->first()){
            $oldMain->main_picture = false;
            $oldMain->save();
        }
        $this->main_picture = true;

    }

    public function deletePhotoAndFile(){
        if($this->main_picture){
            $newMainPhoto = $this->badge->photos->where('id', $this->id+1)->first();
            $newMainPhoto->setAsMain();
            $newMainPhoto->save();
        }

        File::delete([$this->path, $this->thumbnail_path]);

        $this->delete();
    }


}
