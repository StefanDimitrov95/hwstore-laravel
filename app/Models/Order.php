<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
	//specify the relation for Eloquent
	public function client()
	{
		return $this->belongsTo('App\Models\Client');
	}
}