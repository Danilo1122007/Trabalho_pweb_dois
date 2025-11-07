<?php

namespace App\Http\Controllers;

use App\Models\Order;
use PDF;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::where('user_id', Auth::id())->orderByDesc('order_date')->get();
        return view('orders.index', compact('orders'));
    }

    public function show($id)
    {
        $order = Order::with('items.product')->findOrFail($id);
        return view('orders.show', compact('order'));
    }

public function report()
{
    $orders = \App\Models\Order::with('items.product')
        ->where('user_id', \Illuminate\Support\Facades\Auth::id())
        ->orderBy('id')
        ->get();

    $data = [
        'titulo' => 'Relatório de Pedidos',
        'dados'  => $orders,
    ];

    $pdf = PDF::loadView('orders.report', $data);

    return $pdf->download('relatorio_pedidos.pdf');
}


}
