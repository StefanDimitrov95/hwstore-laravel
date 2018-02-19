<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
	//specify the relation for Eloquent
	public function orders()
	{
		return $this->hasMany('App\Models\Order');
	}
}