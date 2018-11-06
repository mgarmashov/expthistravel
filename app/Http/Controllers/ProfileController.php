<?php

namespace App\Http\Controllers;

use App\Models\Order;
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
                $place = $selectedProducts[0]->place() ?? '';
            }
        }
        $selectedProductsIds = $selectedProducts->pluck('id');
        return view('frontend.pages.booking', [
            'oldMonths' => collect($months),
            'oldProductsIds' => $selectedProductsIds,
            'oldPlace' => $place
        ]);
    }

    public function createOrder(Request $request)
    {
        $user = Auth::user();
        $order = new Order;
        $order->user_id = $user->id;
        $order->comment = view('frontend.components.order-to-database', ['data' => $request])->render();
        $order->save();
        foreach ($request->products as $productId) {
            $order->products()->attach($productId);
        }
        $user->products()->detach();

        return redirect(route('thank-for-order'));
    }

    public function thankYouPage(Request $request)
    {
        return view('frontend.pages.booking-thank-you');
    }


}
