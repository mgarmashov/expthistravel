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

        if ($request->country && !in_array('all', $request->country)) {
            $products = Product::filterByCountry($request->country);
        }

        if ($request->month && !in_array('all', $request->month)) {
            $products = Product::filterByMonth($request->month);
        }


        if ($request->duration && !in_array('all', $request->duration)) {
            $products = Product::filterByDuration($request->duration);
        }

        $applyScores = 'no';
        if (Auth::check() && Auth::user()->totalScores && $request->applyScores) {
            $scoresOfUser = Auth::user()->scores();
            $products = Product::findBestProducts($scoresOfUser);
            $applyScores = 'yes';
        }
        if (Auth::check() && ! Auth::user()->totalScores) {
            $applyScores = 'takeQuiz';
        }

        return view('frontend.pages.products', [
            'products' => $products,
            'filter' =>[
                'applyScores' => $applyScores,
                'country' => $request->country ?? null,
                'month' => $request->month ?? null,
                'duration' => $request->duration ?? null
            ],
        ]);
    }
}
