<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
	//override the default Eloquent expected table name
	protected $table = 'productcategory';

	//specify the relation for Eloquent
	public function products()
	{
		return $this->hasMany('App\Models\Product');
	}
}