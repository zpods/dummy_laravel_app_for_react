<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::with(['images'])->get()->take(6);
        return response()->json($products);
    }

    /**
     * Display searched products.
     *
     * @return \Illuminate\Http\Response
     */
    public function searchProducts($name)
    {
        $result = Product::where('name', '=', $name)->with('images')->get();
        if($result){
            return response()->json($result, 200);
        }else{
            return response()->json('Products not found', 404);
        }

    }
}
