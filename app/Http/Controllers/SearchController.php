<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function showPage(Request $request)
    {
        return view('frontend.pages.product-details', ['product' => $product]);
    }
}
