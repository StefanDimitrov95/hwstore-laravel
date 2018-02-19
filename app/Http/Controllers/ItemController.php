<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\Client;
use App\Models\Order;
use App\Models\OrderDetail;

class ItemController extends Controller
{
	/**
	* Get a product and its buyers.
	*
	* @param  int  $id
	* @return \Illuminate\Http\Response
	*/
	public function getProduct($id)
    {
    	$product = Product::find($id);

    	$buyers = OrderDetail::join('orders', 'orders.order_id', '=', 'order_details.orders_order_id')
    	->join('clients', 'clients.client_id', '=', 'orders.client_id')
    	->where('Products_ProductID', $id)->get();

    	return view('item', compact('product', 'buyers'));
    }
}
