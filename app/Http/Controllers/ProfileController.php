<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function showPage()
    {

        $productsInCart = Auth::user()->products()->get();

        return view('frontend.pages.profile', ['products' => $productsInCart]);
    }

    public function orderPage()
    {
        if (Auth::user()) {
            return redirect()->route('profile');
        }

        $productIds = session('cart') ?? [];

        $productsInCart = Product::whereIn('id', $productIds)->get();

        return view('frontend.pages.cart-page', ['products' => $productsInCart]);
    }

    public function bookingPage()
    {
        if (Auth::check()) {
            $user = Auth::user();
            $months = $user->q3;
            $selectedProducts = $user->products()->get();
            $place = $selectedProducts[0]->place() ?? '';
        } else {
            //todo here to continue
        }

        return view('frontend.pages.booking', ['oldMonths' => $months, 'oldProducts' => $selectedProducts, 'oldPlace' => $place]);
    }

    public function sendBookingMessage(Request $request)
    {
        dd($request);
    }
}
