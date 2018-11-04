<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function showPage(Request $request)
    {
        $product = Product::find($request->id);
        return view('frontend.pages.product-details', ['product' => $product]);
    }

    public function toOrder(Request $request)
    {
        if(Auth::user()) {
            $user = Auth::user();
            $exists = DB::table('users_products')
                    ->whereUserId($user->id)
                    ->whereProductId($request->id)
                    ->whereStatus('inCart')
                    ->count() > 0;
            if ($exists) {
                return response()->json("User already has product $request->id in PROFILE cart");
            }
            $user->products()->attach($request->id, ['status' => 'inCart']);
            $user->save();

            return response()->json("Product $request->id is added to PROFILE cart of current user");

        } else {
            $cart = $request->session()->get('cart') ?? [];
            $cart[] = $request->id;
            $cart = array_unique($cart);
            $request->session()->put('cart', $cart);

            return response()->json("Product $request->id is added to SESSION cart");
        }
    }

    public function deleteFromOrder(Request $request)
    {
        if(Auth::user()) {
            $user = Auth::user();
            $user->products()->detach($request->id, ['status' => 'inCart']);
            $user->save();

            return response()->json("Product $request->id is deleted from PROFILE cart of current user");

        } else {
            $cart = $request->session()->get('cart') ?? [];

            if (($key = array_search($request->id, $cart)) !== false) {
                unset($cart[$key]);
            }

            $request->session()->put('cart', $cart);

            return response()->json("Product $request->id is deleted from SESSION cart");
        }
    }
}
