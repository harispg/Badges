<?php

namespace App;

use App\User;
use App\Badge;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
	protected $fillable=['body', 'user_id'];

    public function user(){
    	return $this->belongsTo(User::class);
    }

    public function badge(){
    	return $this->belongsTo(Badge::class);
    }

}
