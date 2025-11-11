<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = auth()->user()->carts()->with('items.product')->latest()->first();
        return view('checkout.index', compact('cart'));
    }

    public function process(Request $request)
    {
        $user = auth()->user();
        $cart = $user->carts()->with('items.product')->latest()->first();
        if (! $cart || $cart->items->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Carrinho vazio');
        }

        $order = Order::create(['user_id' => $user->id, 'total_amount' => 0]);
        $total = 0;
        foreach ($cart->items as $item) {
            $order->items()->create(['product_id' => $item->product_id, 'price' => $item->product->price, 'quantity' => $item->quantity]);
            $total += $item->product->price * $item->quantity;
        }
        $order->total_amount = $total;
        $order->save();

        // clear cart
        $cart->items()->delete();

        return redirect()->route('home')->with('success','Pedido realizado');
    }
}
