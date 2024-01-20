<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Stock;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // All Order
    public function index(){
        $orders = Order::all();
        return view('order.index', compact('orders'));
    }

    // Create Order
    public function create(){
        $stocks = Stock::all();
        return view('order.create', compact('stocks'));
    }

    // Store Order
    public function store(Request $request){
        $formData = $request->validate([
            'stock_id' => 'required',
            'order_quantity' => 'required',
            'order_date' => 'required',
        ]);

        $order = new Order();

        $order->stock_id = $formData['stock_id'];
        $order->order_quantity = $formData['order_quantity'];
        $order->price_option = $request->has('price_option') ? 1 : 0;
        $order->order_date = $formData['order_date'];

        $order->save();

        return redirect()->route('order.index');

    }
}
