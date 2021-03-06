<?php

namespace App;

use App\Tag;
use App\User;
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

    public function users(){
        return $this->belongsToMany(User::class);
    }

    public function savePhoto($photo, $avatar = null)
    {   
        if($avatar){
            $photo->main_picture = true;
        }
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

    public function isLiked($user){
        if($this->users()->find($user) === null){
            return false;
        }
        return true;
    }
    /**
     * Relationship with tags
     * @return relationship
     */
    public function tags(){
        return $this->belongsToMany(Tag::class);
    }

    public function updateAndCreateTags($tags){

        $newTagsNames = array_map('strtolower',explode(',',$tags));
        $tagsIDs=[];
        foreach ($newTagsNames as $name) {
            $tagsIDs[] = Tag::firstOrCreate(["name"=> $name])->id;
        }
        
        $this->tags()->sync($tagsIDs);
    }

}
