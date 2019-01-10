<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = ['name'];

    public function badges()
    {
    	return $this->belongsToMany(Badge::class);
    }

    public function getRouteKeyName(){
    	return 'name';
    }
}
