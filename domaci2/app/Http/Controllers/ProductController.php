<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductCollection;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        return new ProductCollection($products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [ //kupimo taj post
            'name' => 'required|string|max:255',
            'description' => 'required|string|min:50',
            'price' => 'required',
            'product_type' => 'required'
        ]);

        if ($validator->fails())
            return response()->json($validator->errors());

        $product = Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'product_type' => $request->product_type,
            'user_id' => Auth::user()->id,
        ]);

        return response()->json(['Product is created successfully.', new ProductResource($product)]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);
        return new ProductResource($product);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $validator = Validator::make($request->all(), [ //kupimo taj post
            'name' => 'required|string|max:255',
            'description' => 'required|string|min:50',
            'price' => 'required',
            'product_type' => 'required'
        ]);

        if ($validator->fails())
            return response()->json($validator->errors());

        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->product_type = $request->product_type;

        $product->save();

        return response()->json(['Product is updated successfully.', new ProductResource($product)]);

        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return response()->json(['Product is deleted successfully.']);
    }
}
