<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function index()
    {
        $user = Auth::id();
        $session = session()->getId();

        $carts = Cart::with('product')
            ->where('user_id', $user)
            ->orWhere('session_id', $session)
            ->get();

        return view('cart.index', compact('carts'));
    }
    public function updateQuantity(Request $request, $id)
{
    $cart = Cart::findOrFail($id);

    $validated = $request->validate([
        'quantity' => 'required|integer|min:1'
    ]);

    $cart->update(['quantity' => $validated['quantity']]);

    return back()->with('success', 'Quantidade atualizada!');
}

    public function remove($id)
    {
        Cart::findOrFail($id)->delete();
        return back()->with('success', 'Item removido do carrinho.');
    }

    public function checkout()
    {
        DB::transaction(function () {
            $user = Auth::id();
            $session = session()->getId();
            $carts = Cart::where('user_id', $user)
                ->orWhere('session_id', $session)
                ->get();

            if ($carts->isEmpty()) return back()->withErrors('Carrinho vazio!');

            $total = $carts->sum(fn($c) => $c->product->price * $c->quantity);
            $order = Order::create([
                'user_id' => $user,
                'total_price' => $total,
                'order_date' => now(),
            ]);

            foreach ($carts as $cart) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $cart->product_id,
                    'quantity' => $cart->quantity,
                    'price' => $cart->product->price,
                ]);

                if ($cart->product->type === 'produto') {
                    $cart->product->decrement('quantity', $cart->quantity);
                }
            }

            Cart::where('user_id', $user)->orWhere('session_id', $session)->delete();
        });

        return redirect()->route('orders.index')->with('success', 'Compra concluída!');
    }
}
