<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function add(Request $request, Product $product)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $cartItem = Cart::where('user_id', Auth::id())
            ->where('product_id', $product->id)
            ->where('variant_id', $request->variant_id)
            ->first();

        if ($cartItem) {
            $cartItem->quantity += 1;
            $cartItem->save();
        } else {
            Cart::create([
                'user_id' => Auth::id(),
                'product_id' => $product->id,
                'variant_id' => $request->variant_id, 
                'quantity' => 1
            ]);
        }

        return redirect()->back()->with('success', 'Added to cart successfully');
    }

    // BUY NOW
    public function buyNow(Request $request, Product $product)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $cartItem = Cart::where('user_id', Auth::id())
            ->where('product_id', $product->id)
            ->where('variant_id', $request->variant_id)
            ->first();

        if ($cartItem) {
            $cartItem->update(['quantity' => 1]);        } else {
            $cartItem = Cart::create([
                'user_id' => Auth::id(),
                'product_id' => $product->id,
                'variant_id' => $request->variant_id, 
                'quantity' => 1
            ]);
        }

        session(['checkout_items' => [$cartItem->id]]);

        return redirect()->route('checkout.index')->with('success', 'Proceeding to checkout');
    }

    // VIEW CART
    public function index()
    {
        $cartItems = Cart::with('product')
            ->where('user_id', Auth::id())
            ->get();

        $categories = Category::all();
        return view('frontend.cart', compact('cartItems','categories'));
    }

    // REMOVE ITEM
    public function remove($id)
    {
        Cart::where('id', $id)
            ->where('user_id', Auth::id())
            ->delete();

        return back()->with('success', 'Item removed');
    }
}
