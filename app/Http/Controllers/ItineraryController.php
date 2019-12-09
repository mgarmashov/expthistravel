<?php

namespace App\Http\Controllers;

use App\Models\Itinerary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ItineraryController extends Controller
{
    public function showPage(Request $request)
    {
        $itinerary = Itinerary::where('slug', $request->id)
            ->orWhere('id', $request->id)
            ->first();
        if (empty($itinerary)) abort(404);
        $countriesIds = $itinerary->countries()->pluck('countries.id')->toArray();

        $popularPackages = Itinerary::whereHas('countries', function($q) use ($countriesIds) {
            $q->whereIn('countries.id', $countriesIds);
        })->inRandomOrder()->limit(3)->get();


        return view('frontend.pages.itinerary-details', ['itinerary' => $itinerary, 'popularPackages' => $popularPackages]);
    }

    public function toOrder(Request $request)
    {
        if(Auth::user()) {
            $user = Auth::user();
            $exists = DB::table('users_itineraries')
                    ->whereUserId($user->id)
                    ->whereItineraryId($request->id)
                    ->whereStatus('inCart')
                    ->count() > 0;
            if ($exists) {
                return response()->json("User already has itinerary $request->id in PROFILE cart");
            }
            $user->itineraries()->attach($request->id, ['status' => 'inCart']);
            $user->save();

            return response()->json("Itinerary $request->id is added to PROFILE cart of current user");

        } else {
            $cart = $request->session()->get('cart') ?? [];
            $cart[] = $request->id;
            $cart = array_unique($cart);
            $request->session()->put('cart', $cart);

            return response()->json("Itinerary $request->id is added to SESSION cart");
        }
    }

    public function deleteFromOrder(Request $request)
    {
        if(Auth::user()) {
            $user = Auth::user();
            $user->itineraries()->detach($request->id, ['status' => 'inCart']);
            $user->save();

            return response()->json("Itinerary $request->id is deleted from PROFILE cart of current user");

        } else {
            $cart = $request->session()->get('cart') ?? [];

            if (($key = array_search($request->id, $cart)) !== false) {
                unset($cart[$key]);
            }

            $request->session()->put('cart', $cart);

            return response()->json("Itinerary $request->id is deleted from SESSION cart");
        }
    }
}
