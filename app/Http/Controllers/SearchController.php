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
        $itineraries = $results['itineraries'];
        $applyScores = $results['applyScores'];

        return view('frontend.pages.search-results', [
            'products' => $products,
            'itineraries' => $itineraries,
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

    public function updateListByAjax(Request $request)
    {
        $products = $this->applyFilter($request)['products'];
        $itineraries = $this->applyFilter($request)['itineraries'];

        return [
            'products' => view("frontend.components.list-products",compact('products'))->render(),
            'itineraries' => view("frontend.components.list-itineraries",compact('itineraries'))->render(),
        ];
    }



    protected function applyFilter($request)
    {
        $products = $this->findItems($request, 'App\Models\Product');
        $itineraries = $this->findItems($request, 'App\Models\Itinerary');
        $applyScores = 'no';
        if (Auth::check() && ! Auth::user()->totalScores) {
            $applyScores = 'takeQuiz';
        }
        if (Auth::check() && Auth::user()->totalScores && $request->applyScores) {
            $scoresOfUser = Auth::user()->scores();
            $products = Product::findBestProducts($scoresOfUser);
            $itineraries = Itinerary::findBestItineraries($scoresOfUser);
            $applyScores = 'yes';
        } else {
            $products = $products->sortBy(function($product){
                return $product->countries()->first()->index;
            });
            $itineraries = $itineraries->sortBy(function($itinerary){
                return $itinerary->countries()->first()->index;
            });
        }

        return ['applyScores' => $applyScores, 'products' => $products, 'itineraries' => $itineraries];
    }

    protected function findItems($request, $model)
    {
        $output = $model::all();

        if ($request->country && !in_array('all', $request->country)) {
            $output = $model::filterByCountry($request->country);
        }

        if ($request->month && !in_array('all', $request->month)) {
            $output = $model::filterByMonth($request->month);
        }

        if (isset($request->filter_duration_from) || isset($request->filter_duration_to)) {
            $output = $model::filterByDuration([$request->filter_duration_from ?? 1, $request->filter_duration_to ?? 29]);
        }

        if ($request->sights) {
            $output = $model::filterBySights($request->sights);
        }

        if ($request->travel_styles) {
            $output = $model::filterByTravelStyle($request->travel_styles);
        }

        return $output;
    }
}
