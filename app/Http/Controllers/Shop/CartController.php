<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;

class CartController extends Controller
{
    public function index()
    {
        $cart = auth()->check() ? auth()->user()->carts()->with('items.product')->latest()->first() : null;
        return view('cart.index', compact('cart'));
    }

    public function add(Request $request)
    {
        if (! auth()->check()) {
            return redirect()->route('login')->with('error','Faça login para adicionar ao carrinho');
        }

        $request->validate(['product_id' => 'required|exists:products,id','quantity' => 'integer|min:1']);
        $user = auth()->user();
        $cart = $user->carts()->firstOrCreate([]);
        $item = $cart->items()->updateOrCreate(['product_id' => $request->product_id], ['quantity' => $request->input('quantity',1)]);
        return redirect()->back()->with('success','Produto adicionado ao carrinho');
    }

    public function remove(Request $request)
    {
        if (! auth()->check()) {
            return redirect()->route('login')->with('error','Faça login para editar o carrinho');
        }

        $request->validate(['product_id' => 'required|exists:products,id']);
        $user = auth()->user();
        $cart = $user->carts()->latest()->first();
        if ($cart) {
            $cart->items()->where('product_id', $request->product_id)->delete();
        }
        return redirect()->back()->with('success','Produto removido');
    }
}
