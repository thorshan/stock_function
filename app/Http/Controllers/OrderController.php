<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Stock;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $orders = Order::all();
        $stocks = Stock::all();
        return view("orders.index", compact("orders", "stocks"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $stocks = Stock::all();
        return view('orders.create', compact('stocks'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validatedData = $request->validate([
            'stock_id' => 'required|exists:stocks,id',
            'order_quantity' => 'required|integer|min:1',
            'price_option' => 'nullable|boolean',
            'order_date' => 'required|date',
        ]);
    
        $selectedStock = Stock::findOrFail($validatedData['stock_id']);
    
        // Create a new order instance
        $order = new Order();
        $order->stock_id = $validatedData['stock_id'];
        $order->order_quantity = $validatedData['order_quantity'];
        $order->price_option = $request->has('price_option') ? 1 : 0;
        $order->order_date = $validatedData['order_date'];
    
        // Save the order
        $order->save();

        $selectedStock->decrement('quantity', $validatedData['order_quantity']);
    
        return redirect()->route('orders.index')->with('success', 'Order created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
