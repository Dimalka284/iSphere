<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class ProductController extends Controller
{

public function index()
{
    $products = Product::with(['images', 'variants'])->where('category_id',1)->paginate(8);
    $categories = Category::all();
    return view('frontend.phone', compact('products', 'categories'));
}

public function mac(){
    $products = Product::with(['images', 'variants'])->where('category_id',2)->paginate(8);
    $categories = Category::all();
    return view('frontend.mac', compact('products', 'categories'));
}

public function show($id){
    $product = Product::with(['images','variants'])->findorFail($id);
    $categories = Category::all();
    return view('frontend.productdetails',compact('product','categories'));
}

}
