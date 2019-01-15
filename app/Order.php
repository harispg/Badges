<?php

namespace App;

use App\User;
use App\Badge;
use App\OrderItem;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
	public function user(){
		return $this->belongsTo(User::class);
	}

	public function items(){
		return $this->hasMany(OrderItem::class);
	}

	public function status(){
		return $this->belongsToMany(OrderStatus::class,'orderStatusPivot','order_id','status_id' );
	}

	public function addItemOrQuantity($itemAttributes){
		$badge = Badge::find($itemAttributes['badge_id']);
		$item = OrderItem::firstOrNew(
			['name' => $badge->name]
		);
		$item->badge_id = $badge->id;
		$item->order_id = $this->id;
		$item->quantity += $itemAttributes['qty'];

		$item->save();

		return $item;
	}
}
