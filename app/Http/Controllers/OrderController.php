<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $order = Order::findOrFail($id);
        $stocks = Stock::all();
        return view('orders.edit', compact('order', 'stocks'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $validatedData = $request->validate([
            'stock_id' => 'required|exists:stocks,id',
            'order_quantity' => 'required|integer|min:1',
            'price_option' => 'nullable|boolean',
            'order_date' => 'required|date',
        ]);
        // Create a new order instance
        $order = Order::findOrFail($id);

        // Retrieve the existing order quantity
        $existingOrderQuantity = $order->order_quantity;

        $order->stock_id = $validatedData['stock_id'];
        $order->order_quantity = $validatedData['order_quantity'];
        $order->price_option = $request->has('price_option') ? 1 : 0;
        $order->order_date = $validatedData['order_date'];

        // Save the order
        $order->save();

        // Check if the order quantity has changed
        if ($existingOrderQuantity !== $validatedData['order_quantity']) {
            // If the quantity has changed, find the associated stock and decrement the quantity
            $selectedStock = Stock::findOrFail($validatedData['stock_id']);
            $selectedStock->decrement('quantity', $validatedData['order_quantity'] - $existingOrderQuantity);
        }

        return redirect()->route('orders.index')->with('success', 'Order created successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $order = Order::findOrFail($id);

        // Store the current order quantity
        $currentOrderQuantity = $order->order_quantity;

    // Get the associated stock
        $selectedStock = Stock::findOrFail($order->stock_id);

    // Delete the order
        $order->delete();

    // Revert the stock quantity back to its original amount
        DB::transaction(function () use ($selectedStock, $currentOrderQuantity) {
            $selectedStock->increment('quantity', $currentOrderQuantity);
        });
        
        return redirect()->route('orders.index')->with('success','Order deleted successfully.');
    }
}
