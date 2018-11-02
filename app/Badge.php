<?php

namespace App;

use App\Photo;
use App\Comment;
use Illuminate\Database\Eloquent\Model;

class Badge extends Model
{
    protected $fillable = ['name', 'description'];

    public function photos()
    {
    	return $this->hasMany(Photo::class);
    }

    public function savePhoto($photo)
    {
    	$this->photos()->save($photo);
    }

    public function comments(){
    	return $this->hasMany(Comment::class);
    }

    public function addComment($body){
        $this->comments()->create([
            'body' => $body,
            'user_id' => auth()->id(),
        ]);
    }

    public function mainPhoto()
    {
        foreach ($this->photos as $photo) {
            if($photo->main_picture){
                return $photo;
            }
        }
    }

}
