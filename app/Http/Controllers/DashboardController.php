<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Order;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $totProducts = Product::where('type', 'produto')->count();
        $totServices = Product::where('type', 'servico')->count();
        $noStock = Product::where('quantity', 0)->count();
        $sales = Order::count();

$salesPerDay = DB::table('orders')
    ->join('order_items', 'orders.id', '=', 'order_items.order_id')
    ->select(DB::raw('DATE(orders.order_date) as date'), DB::raw('SUM(order_items.quantity) as total'))
    ->groupBy('date')
    ->orderBy('date', 'asc')
    ->take(7)
    ->get();


        return view('dashboard.index', compact('totProducts', 'totServices', 'noStock', 'sales', 'salesPerDay'));
    }
}
