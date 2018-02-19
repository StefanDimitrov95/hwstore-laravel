<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\Manufacturer;
use App\Models\Category;


class HomeController extends Controller
{
	/**
	* Bundle the param with the necessary data for the view
	*
	* @param  array(Product) $products
	* @return \Illuminate\Http\Response
	*/
	public function main($products)
    {
		$manufacturers = Manufacturer::get();
		$categories = Category::get();

        return view('index', compact('products', 'categories', 'manufacturers'));
    }



    /**
    * Display all available products on the index page.
    * Paginate the first 20.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
    	$products = Product::getAllAvailable()->paginate(20);

		return $this->main($products);
    }



	/**
	* Filter products on given criteria.
	* Paginate the 20.
	*
	* @param  \Illuminate\Http\Request $request
	* @return \Illuminate\Http\Response
	*/
    public function filter(Request $request)
    {
    	$input = array_values($request->except('available'));
		$matchThese = array_filter(['ProductCategory_CategoryID' => $input[0], 'Manufacturers_ManufacturerID' => $input[1]]);
		$query = Product::where($matchThese);

		if ($request->has("available"))
		{
			$query->where('ProductAvailability', '1');
		}

		if ($input[2] != NULL && $input[3] != NULL)
		{
			$lo = (int)$input[2];
			$hi = (int)$input[3];
			$query->whereRaw("coalesce(ProductPrice - ProductDiscount, ProductPrice) BETWEEN '$lo' AND '$hi'");
		}
    	
		return $this->main($query->paginate(20));
    }
}