<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Image;
use File;
use App\Models\Product;
use App\Models\Category;
use App\Models\Manufacturer;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $products = Product::findProduct($request->input('search'))->paginate(10);

        return view('admin.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::get();
        $manufacturers = Manufacturer::get();

        return view('admin.create', compact('categories', 'manufacturers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->except(['_token', 'ProductImage']);
        $validation = Validator::make($request->all(), Product::$rules);

        if ($validation->passes())
        {
            if ($request->hasFile('ProductImage'))
            {
                $image = $request->file('ProductImage');
                $fileName = time() . '.' . $image->getClientOriginalExtension();
                $relativePath = 'storage/images/' . $fileName;
                $location = public_path($relativePath);
                Image::make($image)->resize(800, 800, function ($c) {
                    $c->aspectRatio();
                    $c->upsize();
                })->save($location);
                $input['ProductImage'] = $relativePath;
            }
            else
            {
                $input['ProductImage'] = 'storage/images/no-image.png';
            }
            
            $product = Product::create($input);

            return redirect()->route('admin.index');
        }
        return redirect()->back()->withInput()->withErrors($validation);
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);
        $categories = Category::get();
        $manufacturers = Manufacturer::get();

        return view('admin.edit', compact('categories', 'manufacturers'))->withProduct($product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input = $request->except(['_token', 'ProductImage']);
        
        $validation = Validator::make($input, Product::$rules);

        if ($validation->passes())
        {
            $product = Product::find($id);
            if ($request->hasFile('ProductImage'))
            {
                $image = $request->file('ProductImage');
                $fileName = time() . '.' . $image->getClientOriginalExtension();
                $relativePath = 'storage/images/' . $fileName;
                $location = public_path($relativePath);
                Image::make($image)->resize(800, 800, function ($c) {
                    $c->aspectRatio();
                    $c->upsize();
                })->save($location);
                $input['ProductImage'] = $relativePath;
                File::delete($product->ProductImage);
                $input['ProductImage'] = $relativePath;
            }
            $product->update($input);

            return redirect()->route('admin.index');
        }
        return redirect()->back()->withInput()->withErrors($validation);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Product::find($id)->delete();

        return redirect()->route('admin.index');
    }
}
