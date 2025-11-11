<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ShopController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->paginate(12);
        return view('shop.index', compact('products'));
    }

    public function show($slug)
    {
        $product = Product::where('id', $slug)->orWhere('name', $slug)->firstOrFail();
        return view('shop.show', compact('product'));
    }
}
