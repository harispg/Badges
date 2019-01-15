<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderStatus extends Model
{
    public $timestamps = false;

    public function orders(){
		return $this->belongsToMany(Order::class,'orderStatusPivot','status_id','order_id' );
	}
}
