<?php

namespace App\Http\Controllers;

use App\Models\Campuses;
use App\Models\Stock;
use Illuminate\Http\Request;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $stocks = Stock::all();
        return view("stocks.index", compact("stocks"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $campus = Campuses::all();
        return view("stocks.create", compact("campus"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request){

        $validatedData = $request->validate([
            'name' => 'required|string',
            "campus_id"=> "required",
            'quantity' => 'required|integer|min:0',
            'level_type' => 'required',
            "price"=> "required|integer|min:0",
            "date"=> "required",
        ]);

        $stock = new Stock();
        $stock->name = $validatedData['name'];
        $stock->quantity = $validatedData['quantity'];
        $stock->total_quantity = $validatedData['quantity'];
        $stock->price = $validatedData['price'];
        $stock->date = $validatedData['date'];
        $stock->campus_id = $validatedData['campus_id'];
        $stock->level_type = $validatedData['level_type'];

        $stock->save();

        return redirect()->route('stocks.index')->with('success', 'Stock added successfully');
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
        $stock = Stock::findOrFail($id);
        $campus = Campuses::all();
        return view("stocks.edit", compact("stock", "campus"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Stock $stock)
    {
        //
        $validatedData = $request->validate([
            "name"=> "required",
            "campus_id"=> "required",
            "level_type"=> "required",
            "total_quantity"=> "required|integer|min:0",
            "price"=> "required|integer|min:0",
            "date"=> "required",
        ]);
    
        $stock->fill($validatedData);

        if ($stock->isDirty('total_quantity')) {
            // If total_quantity is being changed, calculate the difference and adjust both quantity and total_quantity
            $originalTotalQuantity = $stock->getOriginal('total_quantity');
            $requestedTotalQuantity = $stock->total_quantity;
            $quantityDifference = $requestedTotalQuantity + $originalTotalQuantity;

            // Adjust both total_quantity and quantity
            $stock->total_quantity = $quantityDifference;
            $stock->quantity += $requestedTotalQuantity;
        }

        $stock->save();
        return redirect()->route("stocks.index")->with("success","Stock updated successfully.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $stock = Stock::findOrFail($id);
        $stock->delete();
        return redirect()->route("stocks.index");
    }
}
