<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Category;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function index()
    {
        $selectedIds = session('checkout_items', []);
        
        if (empty($selectedIds)) {
            return redirect()->route('cart.index')->with('error', 'Please select items to checkout.');
        }

        $cartItems = Cart::with(['product', 'variant'])
            ->where('user_id', Auth::id())
            ->whereIn('id', $selectedIds)
            ->get();
        
        $categories = Category::all();
        
        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'The selected items are no longer in your cart.');
        }

        $subtotal = 0;
        foreach ($cartItems as $item) {
            $subtotal += $item->variant->price * $item->quantity;
        }

        return view('frontend.checkout', compact('cartItems', 'subtotal','categories'));
    }

    public function process(Request $request)
    {
        $validatedData = $request->validate([
            'firstName' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'phoneNumber' => 'required|string|max:20',
            'address' => 'required|string|max:500',
            'province' => 'required|string|max:255',
            'district' => 'required|string|max:255',
        ]);

        $user = Auth::user();
        $selectedIds = session('checkout_items', []);

        if (empty($selectedIds)) {
            return redirect()->route('cart.index')->with('error', 'No items selected for checkout.');
        }

        $cartItems = Cart::with('variant')
            ->where('user_id', $user->id)
            ->whereIn('id', $selectedIds)
            ->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your selection is empty.');
        }

        $totalAmount = 0;
        foreach ($cartItems as $item) {
            $totalAmount += $item->variant->price * $item->quantity;
        }

        // Create Order
        $order = Order::create([
            'user_id' => $user->id,
            'first_name' => $validatedData['firstName'],
            'last_name' => $validatedData['lastName'],
            'phone_number' => $validatedData['phoneNumber'],
            'address' => $validatedData['address'],
            'province' => $validatedData['province'],
            'district' => $validatedData['district'],
            'total_amount' => $totalAmount,
            'payment_method' => 'stripe',
            'payment_status' => 'pending',
            'status' => 'pending',
        ]);

        // Create Order Items
        foreach ($cartItems as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'variant_id' => $item->variant_id,
                'quantity' => $item->quantity,
                'price' => $item->variant->price,
            ]);
        }

        // Clear checked out items from Cart
        Cart::where('user_id', $user->id)->whereIn('id', $selectedIds)->delete();
        session()->forget('checkout_items');

        // Redirect to Stripe Checkout using Cashier's checkoutCharge
        return $user->checkoutCharge(intval($totalAmount * 100), 'Order #' . $order->id, 1, [
            'success_url' => route('success') . '?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('checkout.index'),
            'client_reference_id' => $order->id,
        ]);
    }
}
