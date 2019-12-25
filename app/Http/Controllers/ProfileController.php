<?php

namespace App\Http\Controllers;

use App\Events\NewOrderEvent;
use App\Models\Itinerary;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function showProductsPage()
    {

        $productsInCart = Auth::user()->products()->get();
        $itinerariesInCart = Auth::user()->itineraries()->get();

        return view('frontend.pages.profile.products', ['products' => $productsInCart, 'itineraries' => $itinerariesInCart]);
    }

    public function showProfilePage(Request $request)
    {

//        $productsInCart = Auth::user()->products()->get();

        return view('frontend.pages.profile.show');
    }

    public function showEditPage(Request $request)
    {

//        $productsInCart = Auth::user()->products()->get();

        return view('frontend.pages.profile.edit');
    }

    public function saveProfile(Request $request)
    {
        if(!Auth::check()) {
            return redirect()->url('/');
        }

        $user = Auth::user();
        if($request->input('login')) {
            $user->login = $request->input('login');
        }
        $user->name = $request->input('name') ?? '';
        $user->surname = $request->input('surname') ?? '';
        $user->phone = $request->input('phone') ?? '';
        $user->save();

        return view('frontend.pages.profile.show');
    }

    public function orderPage()
    {
        if (Auth::user()) {
            return redirect()->route('profile.products');
        }

        $productIds = session('cart.products') ?? [];
        $itinerariesIds = session('cart.itineraries') ?? [];

        $productsInCart = Product::whereIn('id', $productIds)->get();
        $itinerariesInCart = Itinerary::whereIn('id', $itinerariesIds)->get();

        return view('frontend.pages.cart-page', ['products' => $productsInCart, 'itineraries' => $itinerariesInCart]);
    }

    public function bookingPage()
    {
        if (Auth::check()) {
            $user = Auth::user();
            $months = $user->q3 ?? [];
            $selectedProducts = $user->products()->get();
            $selectedItineraries = $user->itineraries()->get();
            $place = count($selectedProducts) ? $selectedProducts[0]->place() : '';
            $adults = $user->q_how_many_adults ?? session()->get('q_how_many_adults') ?? '2';
            $childs = $user->q_how_many_child ?? session()->get('q_how_many_child') ?? '0';
        } else {
            $months = [];
            $selectedProducts = collect();
            $selectedItineraries = collect();
            $place = '';
            $adults = session()->get('q_how_many_adults') ?? '2';
            $childs = session()->get('q_how_many_child') ?? '0';


            if (session('q3')) {
                $months = array_keys(session('q3')) ?? [];
            }
            if (session('cart.products')) {
                $selectedProducts = Product::whereIn('id', session('cart.products'))->get();
                $countryId = $selectedProducts[0]->country->id ?? '';
            }
            if (session('cart.itineraries')) {
                $selectedItineraries = Itinerary::whereIn('id', session('cart.itineraries'))->get();
                $countryId = $selectedItineraries[0]->country->id ?? '';
            }
        }
        $selectedProductsIds = $selectedProducts->pluck('id');
        $selectedItinerariesIds = $selectedItineraries->pluck('id');
        return view('frontend.pages.booking', [
            'oldMonths' => collect($months),
            'oldProductsIds' => $selectedProductsIds ?? [],
            'oldItinerariesIds' => $selectedItinerariesIds ?? [],
            'oldCountryId' => $countryId ?? '',
            'oldAdults' => $adults,
            'oldChilds' => $childs,
        ]);
    }

    public function createOrder(Request $request)
    {
        $order = new Order;
        $order->user_id = 0;
        if (Auth::check()) {
            $user = Auth::user();
            $order->user_id = $user->id;
        }

        $order->comment = view('frontend.components.order-to-database', ['data' => $request])->render();
        $order->save();

        if(isset($request->products)) {
            foreach ($request->products as $productId) {
                $order->products()->attach($productId);
            }
        }
        if(isset($request->itineraries)) {
            foreach ($request->itineraries as $itineraryId) {
                $order->products()->attach($itineraryId);
            }
        }

        if (isset($user)) {
            $user->products()->detach();
        }
        if (isset($user)) {
            $user->itineraries()->detach();
        }

        event(new NewOrderEvent($order));

        return redirect(route('thank-for-order'));
    }

    public function thankYouPage(Request $request)
    {
        return view('frontend.pages.booking-thank-you');
    }


}
