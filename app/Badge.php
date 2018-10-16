<?php

namespace App;

use App\Photo;
use Illuminate\Database\Eloquent\Model;

class Badge extends Model
{
    protected $fillable = ['name', 'description', 'photo_path'];

    public function photos()
    {
    	return $this->hasMany(Photo::class);
    }

    public function savePhoto($photo)
    {
    	$this->photos()->save($photo);
    }

}
