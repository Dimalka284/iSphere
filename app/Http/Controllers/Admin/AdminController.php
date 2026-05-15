<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductImage;
use App\Models\ProductVariant;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index()
    {
        $products = Product::latest()->paginate(10);
        $categories = Category::all();
        return view('admin.products.index', compact('products','categories'));
    }

    public function dashboard(){
        $products = Product::oldest()->paginate(10);
        $categories = Category::all();
        $customs = User::all();
        
        // Fetch sales grouped by month for the current year
        $sales = Order::select(
            DB::raw('MONTH(created_at) as month'),
            DB::raw('SUM(total_amount) as total_sales')
        )
        ->where('payment_status', 'paid')
        ->whereYear('created_at', date('Y'))
        ->groupBy(DB::raw('MONTH(created_at)'))
        ->orderBy(DB::raw('MONTH(created_at)'))
        ->get();

        // Calculate total revenue for the year
        $totalRevenue = Order::where('payment_status', 'paid')
            ->whereYear('created_at', date('Y'))
            ->sum('total_amount');

        return view('admin.dashboard', compact('products', 'categories', 'sales', 'customs', 'totalRevenue'));
    }


    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        // Basic validation
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric',
        ]);

        // Create Product
        $product = Product::create([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
        ]);

        // Handle Variants
        if ($request->has('variants')) {
            foreach ($request->variants as $variant) {
                // Create if any information is provided (even just stock)
                if (!empty($variant['color']) || !empty($variant['storage']) || isset($variant['stock']) || !empty($variant['price'])) {
                    $product->variants()->create([
                        'color' => $variant['color'] ?? null,
                        'storage' => $variant['storage'] ?? null,
                        'stock' => $variant['stock'] ?? 0,
                        'price' => $variant['price'] ?? null,
                    ]);
                }
            }
        }

        // Handle Images (Local Uploads)
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('products', 'public');
                $product->images()->create([
                    'image_path' => $path,
                ]);
            }
        }

        // Handle Images (External URLs)
        if ($request->filled('image_urls')) {
            $urls = explode("\n", str_replace("\r", "", $request->image_urls));
            foreach ($urls as $url) {
                $url = trim($url);
                if (!empty($url)) {
                    $product->images()->create([
                        'image_path' => $url,
                    ]);
                }
            }
        }

        return redirect('/dashboard')->with('success', 'Product created successfully!');
    }

    public function edit($id)
    {
        $product = Product::with(['variants', 'images'])->findOrFail($id);
        $categories = Category::all();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric',
        ]);

        $product = Product::findOrFail($id);
        $product->update([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
        ]);

        // Handle Variants (Recreate for simplicity with the current dynamic frontend)
        if ($request->has('variants')) {
            $product->variants()->delete(); 
            foreach ($request->variants as $variant) {
                if (!empty($variant['color']) || !empty($variant['storage']) || isset($variant['stock']) || !empty($variant['price'])) {
                    $product->variants()->create([
                        'color' => $variant['color'] ?? null,
                        'storage' => $variant['storage'] ?? null,
                        'stock' => $variant['stock'] ?? 0,
                        'price' => $variant['price'] ?? null,
                    ]);
                }
            }
        }

        // Handle Images (External URLs)
        if ($request->filled('image_urls')) {
            // Keep local images, replace external ones for this simple logic
            $product->images()->where('image_path', 'LIKE', 'http%')->delete();
            $urls = explode("\n", str_replace("\r", "", $request->image_urls));
            foreach ($urls as $url) {
                $url = trim($url);
                if (!empty($url)) {
                    $product->images()->create(['image_path' => $url]);
                }
            }
        }

        // Handle Images (New Local Uploads)
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('products', 'public');
                $product->images()->create(['image_path' => $path]);
            }
        }

        return redirect('/dashboard')->with('success', 'Product updated successfully!');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect()->back()->with('success', 'Product deleted successfully!');
    }
}
