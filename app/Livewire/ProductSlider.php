<?php

namespace App\Livewire;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class ProductSlider extends Component
{
    
    public $product;

    public $selectedImage;

    public $activeColor;
    public $activeStorage;

    public $selectedVariant;

    public $colors = [];
    public $storages = [];

    public $quantity = 1;

    public function mount($product)
    {
        $this->product = $product;

        // Default image
        $this->selectedImage = $product->images[0]->image_path ?? null;

        // Get unique colors
        $this->colors = $product->variants
            ->pluck('color')
            ->unique()
            ->values()
            ->toArray();

        // Set default color
        $this->activeColor = $this->colors[0] ?? null;

        $this->updateVariants();
    }

    /* ---------------- IMAGE ---------------- */
    public function selectImage($imagePath)
    {
        $this->selectedImage = $imagePath;
    }

    /* ---------------- COLOR ---------------- */
    public function selectColor($color)
    {
        $this->activeColor = $color;
        $this->updateVariants();
    }

    /* ---------------- STORAGE ---------------- */
    public function selectStorage($storage)
    {
        $variant = $this->product->variants
            ->where('color', $this->activeColor)
            ->where('storage', $storage)
            ->first();

        if ($variant) {
            $this->selectedVariant = $variant;
            $this->activeStorage = $storage;
        }
    }

    /* ---------------- CORE LOGIC ---------------- */
    private function updateVariants()
    {
        $variants = $this->product->variants
            ->where('color', $this->activeColor);

        $this->storages = $variants
            ->pluck('storage')
            ->unique()
            ->values()
            ->toArray();

        $this->selectedVariant = $variants->first();

        if ($this->selectedVariant) {
            $this->activeStorage = $this->selectedVariant->storage;
        }
    }

    /* ---------------- QUANTITY ---------------- */
    public function incrementQuantity()
    {
        $this->quantity++;
    }

    public function decrementQuantity()
    {
        if ($this->quantity > 1) {
            $this->quantity--;
        }
    }

    public function addToCart()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        session()->flash('success', 'Product added to cart successfully.');
    }

    public function render()
    {
        return view('livewire.product-slider');
    }
}



