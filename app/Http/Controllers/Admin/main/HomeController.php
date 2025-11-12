<?php
namespace App\Http\Controllers\Admin\main;

use App\Http\Controllers\Controller;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::all(); // Busca todos os produtos
        return view('admin.main.home', compact('products')); // Passa produtos para a view
    }
}