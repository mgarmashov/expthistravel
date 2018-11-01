<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class SearchController extends Controller
{
    public function showPage(Request $request)
    {
        $products = Product::all();

        if ($request->country && !in_array('0', $request->country)) {
            $products = Product::filterByCountry($request->country);
        }

        if ($request->month && !in_array('0', $request->month)) {
            $products = Product::filterByMonth($request->month);
        }


        if ($request->duration && !in_array('0', $request->duration)) {
            $products = Product::filterByDuration($request->duration);
        }

        if (Auth::check() && $request->applyScores) {
            $scoresOfUser = Auth::user()->score();
            $products = Product::findBestProducts($scoresOfUser);
        }

        return view('frontend.pages.products', [
            'products' => $products,
            'filter' =>[
                'applyScores' => true,
                'country' => $request->country ?? null,
                'month' => $request->month ?? null,
                'duration' => $request->duration ?? null
            ],
        ]);
    }
}
