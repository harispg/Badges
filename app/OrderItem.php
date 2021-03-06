<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
	protected $guarded=[];
    public function badge()
    {
    	return $this->belongsTo(Badge::class);
    }

    public function order()
    {
    	return $this->belongsTo(Order::class);
    }
}
