<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\JsonResponse;

class ProductController extends Controller
{
    /**
     * Display list of products together with images belonging to it.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index() : JsonResponse
    {
        $products = Product::with(['images'])->get();
        return response()->json($products, 200);
    }

    /**
     * Display searched products with details (images, description, number products in stock etc).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function searchProduct($searchedData) : JsonResponse
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
