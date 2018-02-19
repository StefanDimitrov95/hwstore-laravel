<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
	//disable saving timestamps in the DB
	public $timestamps = false;
	
	//override the default Eloquent expected primary key
	protected $primaryKey  = 'ProductID';

	//specify the user-fillable properties
	protected $fillable = array('ProductName', 'ProductCategory_CategoryID', 'Manufacturers_ManufacturerID', 'ProductPrice', 'ProductDiscount', 'ProductImage', 'ProductDescription', 'ProductWarranty', 'ProductAvailability');

	//specify rules for validating the fillable properties
	public static $rules = array(
		'ProductName' => 'required|min:5|max:50',
		'ProductPrice' => 'required|numeric',
		'ProductDescription' => 'nullable|max:255',
		'ProductDiscount' => 'nullable|numeric',
		'ProductWarranty' => 'required|numeric',
		'ProductImage' => 'sometimes|mimes:jpeg,png'
	);


	/**
    * Find products for the CRUD index search function.
    *
    * @param string $keyword
    * @return array(Product)
    */
	public static function findProduct($keyword)
	{
		return self::where('ProductName','like','%'.$keyword.'%');
	}

	/**
    * Get all available products.
    *
    * @return array(Product)
    */
	public static function getAllAvailable() 
	{
		return self::where('ProductAvailability', '1');
	}

	//specify relations for Eloquent
	public function category()
	{
		return $this->belongsTo('App\Models\Category');
	}

	public function manufacturer()
	{
		return $this->belongsTo('App\Models\Manufacturer');
	}
}