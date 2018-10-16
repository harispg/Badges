<?php

namespace App;

use App\Badge;
use Illuminate\Database\Eloquent\Model;
use Iluminate\Http\UploadedFile;
use Image;

class Photo extends Model
{
	protected $baseDir = 'Images/Badges';

    protected $fillable=['name', 'path', 'thumbnail_path', 'badge_id'];

    public function badges(){	
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


}
