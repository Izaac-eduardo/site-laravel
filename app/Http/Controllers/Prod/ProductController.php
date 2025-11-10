<?php

namespace App\Http\Controllers\Prod;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
      public function index()
    {
        $products = Product::all();
        // Usar a view do admin para o CRUD de produtos
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        // Mostrar formulário do admin
        return view('admin.products.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'description' => 'nullable',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0'
        ]);

        Product::create($request->only('name', 'description', 'price', 'stock'));
        return redirect()->route('products.index')
         ->with('success', 'Produto criado com sucesso');
    }

    public function edit(Product $product)
    {
        return view('admin.products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    
    {
        if (!$product = Product::find($product)) {
            return back()->with('message', 'Produto não encontrado');
        }
        $request->validate([
            'name' => 'required|max:255',
            'description' => 'nullable',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0'
        ]);

        $product->update($request->only('name', 'description', 'price', 'stock'));
        return redirect()->route('products.index');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')
        ->with('success', 'Produto deletado com sucesso');
    }

}
