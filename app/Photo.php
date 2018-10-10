<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Badge;

class Photo extends Model
{
    protected $fillable=['name', 'path', 'thumbnail_path'];

    public function badges(){	
    	return $this->belongsTo(Badge::class);
    }
}
