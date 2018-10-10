<?php

namespace App;

use App\Badge;
use Illuminate\Database\Eloquent\Model;
use Iluminate\Http\UploadedFile;

class Photo extends Model
{
    protected $fillable=['name', 'path', 'thumbnail_path', 'badge_id'];

    public function badges(){	
    	return $this->belongsTo(Badge::class);
    }


}
