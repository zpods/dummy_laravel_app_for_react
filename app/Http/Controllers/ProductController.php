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
        $products = Product::with(['images'])->get();
        return response()->json($products);
    }

    /**
     * Display searched products.
     *
     * @return \Illuminate\Http\Response
     */
    public function searchProduct($searchedData)
    {
        if(is_numeric($searchedData)){
            $result = Product::where('id', '=', $searchedData)->with('images')->get();
            if($result){
                return response()->json($result, 200);
            }else{
                return response()->json('Products not found', 404);
            }
        }else{
            $result = Product::where('name', '=', $searchedData)->with('images')->get();
            if($result){
                return response()->json($result, 200);
            }else{
                return response()->json('Products not found', 404);
            }
        }
    }
}
