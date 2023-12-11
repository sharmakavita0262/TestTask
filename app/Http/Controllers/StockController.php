<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use App\Models\Stock;
use Illuminate\Http\Request;

class StockController extends Controller
{
  public function index(Request $request)
  {
    $stocks = Stock::all();
    return view('stocks.index')->with(compact('stocks'));
  }

  public function buyStock(Request $request)
  {
    $stockSymbol = $request->input('stock_symbol');
    $quantity = $request->input('quantity');
    $user = $request->user();

    $stock = Stock::where('symbol', $stockSymbol)->firstOrFail();

    Portfolio::create([
      'user_id' => $user->id,
      'stock_id' => $stock->id,
      'transaction_type' => 'b',
      'quantity' => $quantity,
      'price' => $stock->price,
    ]);
    $status = 200;
    $message = "success";
    return response()->json(compact('message', 'status'), $status);
  }
}
