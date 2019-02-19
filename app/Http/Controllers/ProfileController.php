<?php

namespace App\Http\Controllers;

use App\Events\NewOrderEvent;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function showProductsPage()
    {

        $productsInCart = Auth::user()->products()->get();

        return view('frontend.pages.profile.products', ['products' => $productsInCart]);
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

        $productIds = session('cart') ?? [];

        $productsInCart = Product::whereIn('id', $productIds)->get();

        return view('frontend.pages.cart-page', ['products' => $productsInCart]);
    }

    public function bookingPage()
    {
        if (Auth::check()) {
            $user = Auth::user();
            $months = $user->q3 ?? [];
            $selectedProducts = $user->products()->get();
            $place = $selectedProducts[0]->place() ?? '';
        } else {
            $months = [];
            $selectedProducts = collect();
            $place = '';


            if (session('q3')) {
                $months = array_keys(session('q3')) ?? [];
            }
            if (session('cart')) {
                $selectedProducts = Product::whereIn('id', session('cart'))->get();
                $countryId = $selectedProducts[0]->country->id ?? '';
            }
        }
        $selectedProductsIds = $selectedProducts->pluck('id');
        return view('frontend.pages.booking', [
            'oldMonths' => collect($months),
            'oldProductsIds' => $selectedProductsIds ?? [],
            'oldCountryId' => $countryId ?? ''
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

        if (isset($user)) {
            $user->products()->detach();
        }

        event(new NewOrderEvent($order));

        return redirect(route('thank-for-order'));
    }

    public function thankYouPage(Request $request)
    {
        return view('frontend.pages.booking-thank-you');
    }


}
