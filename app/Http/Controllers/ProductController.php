<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function showPage(Request $request)
    {
        $product = Product::find($request->id);
        return view('frontend.pages.product-details', ['product' => $product]);
    }
}
