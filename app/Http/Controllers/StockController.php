<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use Illuminate\Http\Request;

class StockController extends Controller
{
    //
    public function index(){
        $stocks = Stock::all();
        return view('index', compact('stocks'));
    }

    // Create Stock
    public function create(){
        return view('create');
    }

    // Store Stock
    public function store(Request $request){

        $formData = $request->validate([
            'name' => 'required',
            'level_type' => 'required',
            'quantity' => 'required',
            'price' => 'required',
            'date' => 'required',
        ]);

        $stock = new Stock();

        $stock->name = $formData['name'];
        $stock->level_type = $formData['level_type'];
        $stock->quantity = $formData['quantity'];
        $stock->price = $formData['price'];
        $stock->date = $formData['date'];

        $stock->save();

        return redirect()->route('stock.index');
    }
}
