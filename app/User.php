<?php

namespace App;

use App\Badge;
use App\Photo;
use App\Comment;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'provided_id',
    ];

    protected $sueprAdmin;

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function isSuper(){
        return $this->superAdmin;
    }

    public function badges(){
        return $this->belongsToMany(Badge::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function photos(){
        return $this->belongsToMany(Photo::class);
    }

    public function orders(){
        return $this->hasMany(Order::class);
    }
}
