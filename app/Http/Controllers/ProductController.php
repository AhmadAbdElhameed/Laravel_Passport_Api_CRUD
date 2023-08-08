<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request){
        $user_id = $request->user()->id;
        $products= Product::where('user_id',$user_id)->get();

        return response($products,201);
    }

    public function store(Request $request){
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required|max:255',
            'price' => 'required',

        ]);

        Product::create([
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
            'user_id'=>$request->user()->id,
        ]);

        return response([
            'message' => 'product has been created successfully!'
        ],201);
    }

    public function show(Product $product){
        return response($product,201);
    }
    public function update(Request $request ,Product $product){
        $product->update([
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
            'user_id'=>$request->user()->id,
        ]);
        return response([
            'message' => 'product has been updated successfully!'
        ],201);
    }

    public function destroy(Product $product){
        $product->delete();
        return response([
            'message' => 'product has been deleted successfully!'
        ],201);
    }


}
