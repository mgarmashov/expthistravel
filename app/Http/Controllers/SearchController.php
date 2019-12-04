<?php

namespace App\Http\Controllers;

use App\Models\Itinerary;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class SearchController extends Controller
{
    public function showPage(Request $request)
    {

        $results = $this->applyFilter($request);
        $products = $results['products'];
        $applyScores = $results['applyScores'];

        return view('frontend.pages.products', [
            'products' => $products,
            'filter' =>[
                'applyScores' => $applyScores,
                'country' => $request->country ?? null,
                'month' => $request->month ?? null,
                'duration' => $request->duration ?? null,
                'travel_styles' => $request->travel_styles ?? null,
                'sights' => $request->sights ?? null,
            ],
        ]);
    }

    public function showItinerariesPage(Request $request)
    {

        $itineraries = Itinerary::all();

        return view('frontend.pages.Itineraries', [
            'itineraries' => $itineraries
        ]);
    }

    public function showList(Request $request)
    {
        $products = $this->applyFilter($request)['products'];

        return view("frontend.components.list-products",compact('products'));
    }

    protected function foundProducts($request)
    {
        $products = Product::all();

        if ($request->country && !in_array('all', $request->country)) {
            $products = Product::filterByCountry($request->country);
        }

        if ($request->month && !in_array('all', $request->month)) {
            $products = Product::filterByMonth($request->month);
        }

        if (isset($request->filter_duration_from) || isset($request->filter_duration_to)) {
            $products = Product::filterByDuration([$request->filter_duration_from ?? 1, $request->filter_duration_to ?? 29]);
        }

        if ($request->sights) {
            $products = Product::filterBySights($request->sights);
        }

        if ($request->travel_styles) {
            $products = Product::filterByTravelStyle($request->travel_styles);
        }

        return $products;
    }

    protected function applyFilter($request)
    {
        $products = $this->foundProducts($request);
        $applyScores = 'no';
        if (Auth::check() && Auth::user()->totalScores && $request->applyScores) {
            $scoresOfUser = Auth::user()->scores();
            $products = Product::findBestProducts($scoresOfUser);
            $applyScores = 'yes';
        }
        if (Auth::check() && ! Auth::user()->totalScores) {
            $applyScores = 'takeQuiz';
        }
        return ['applyScores' => $applyScores, 'products' => $products];
    }
}
