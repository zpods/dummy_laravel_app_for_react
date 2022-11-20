<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Http\JsonResponse;


class CartController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function storeUserCart(Request $request) : JsonResponse
    {
        $data = $request->post();
        $products = json_decode($data["data"]);
        $user = Auth::user();
        $user_id = $user->id;
        $user_model = User::findOrFail($user_id);
        if ($products) {
            foreach ($products as $product) {
                $user_model->products()->syncWithoutDetaching($product->id);
                $user_model->products()->updateExistingPivot($product->id, ['quantity' => $product->inCart]);
            }
        }
        return response()->json(['cart_stored' => $products], 204);
    }
        
    /**
     * send user cart to frontend 
     *
     *  @return JsonResponse
     */
    public function sendUserCart() : JsonResponse
    {
        $response = [];
        $user_id = Auth::user()->id;
        $user = User::findOrFail($user_id);

        if ($user) {
            $products = $user->products()->get();
            if ($products) {
                $response = json_encode($products);
                return response()->json(['cart_products' => $response], 200);
            } else {
                return response()->json(['cart_products' => []], 200);
            }
        }
    }

    /** 
    * remove all products from cart
    * @return JsonResponse
    */
    public function removeAllProductsFromCart() : JsonResponse
    {
        $user = Auth::user();
        $user_id = $user;
        DB::table('product_user')->whereIn('user_id', $user_id)->delete();
        return response()->json(['cart_products_of_user_removed' => $user_id], 200);
    }
}
