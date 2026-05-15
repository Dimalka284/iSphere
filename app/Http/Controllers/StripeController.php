<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class StripeController extends Controller
{
    public function checkout(Product $product)
    {
        return auth()->user()->checkout(
            [$product->stripe_price_id => 1],
            [
                'success_url' => route('success'),
                'cancel_url' => url()->previous(),
            ]
        );
        
    }

    public function success(Request $request)
    {
        $sessionId = $request->get('session_id');

        if ($sessionId) {
            \Stripe\Stripe::setApiKey(config('cashier.secret'));
            try {
                $session = \Stripe\Checkout\Session::retrieve($sessionId);

                if ($session && $session->payment_status === 'paid') {
                    $order = \App\Models\Order::find($session->client_reference_id);
                    if ($order && $order->payment_status !== 'paid') {
                        $order->payment_status = 'paid';
                        $order->save();
                    }
                }
            } catch (\Exception $e) {
                // If session retrieval fails, ignore for now
            }
        }

        $categories = Category::all();
        return view('frontend.success', compact('categories'));
    }
}
