<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class CartPage extends Component
{
    public $quantities = [];
    public $selected = [];

    public function mount()
    {
        $cartItems = Cart::with(['product.images', 'variant'])->where('user_id', Auth::id())->get();
        foreach ($cartItems as $item) {
            $this->quantities[$item->id] = $item->quantity;
            $this->selected[$item->id] = true; // Select all by default
        }
    }

    public function increment($cartId)
    {
        if (isset($this->quantities[$cartId])) {
            $this->quantities[$cartId]++;
            Cart::where('id', $cartId)->where('user_id', Auth::id())->update(['quantity' => $this->quantities[$cartId]]);
        }
    }

    public function decrement($cartId)
    {
        if (isset($this->quantities[$cartId]) && $this->quantities[$cartId] > 1) {
            $this->quantities[$cartId]--;
            Cart::where('id', $cartId)->where('user_id', Auth::id())->update(['quantity' => $this->quantities[$cartId]]);
        }
    }

    public function removeItem($cartId)
    {
        Cart::where('id', $cartId)->where('user_id', Auth::id())->delete();
        if (isset($this->quantities[$cartId])) {
            unset($this->quantities[$cartId]);
        }
        if (isset($this->selected[$cartId])) {
            unset($this->selected[$cartId]);
        }
    }

    public function render()
    {
        $cartItems = Cart::with(['product.images', 'variant'])->where('user_id', Auth::id())->get();
        
        $subtotal = 0;
        foreach ($cartItems as $item) {
            if (!empty($this->selected[$item->id])) {
                $subtotal += $item->variant->price * ($this->quantities[$item->id] ?? $item->quantity);
            }
        }

        return view('livewire.cart-page', [
            'cartItems' => $cartItems,
            'subtotal' => $subtotal
        ]);
    }

    public function checkout()
    {
        $selectedIds = array_keys(array_filter($this->selected));
        
        if (empty($selectedIds)) {
            session()->flash('error', 'Please select at least one item to checkout.');
            return;
        }

        session(['checkout_items' => $selectedIds]);
        return redirect()->route('checkout.index');
    }
}
