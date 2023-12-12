<?php

namespace App\Http\Controllers;

use App\Http\Requests\StockRequest;
use App\Models\Portfolio;
use App\Models\Stock;
use Illuminate\Http\Request;
use Throwable;

class StockController extends Controller
{
  public function index(Request $request)
  {
    $stocks = Stock::all();
    return view('stocks.index')->with(compact('stocks'));
  }

  public function buyStock(StockRequest $request)
  {
    try{
      $status = 200;
      $message = "success";
      $stockSymbol = $request->input('stock_symbol');
      $quantity = $request->input('quantity');
      $user = $request->user();

      $stock = Stock::where('symbol', $stockSymbol)->firstOrFail();

      Portfolio::create([
        'user_id' => $user->id,
        'stock_id' => $stock->id,
        'quantity' => $quantity,
        'price' => $stock->price,
      ]);
    }catch(Throwable $th){
      $status = 500;
      $message = NULL;
    }

    return response()->json(compact('message', 'status'), $status);
  }

  public function sellStock(Request $request)
  {
    try{
      $status = 200;
      $message = "success";
      $stockSymbol = $request->input('stock_symbol');
      $portfolioId = $request->input('portfolio_id');
      $user = $request->user();

      $portfolio = Portfolio::where('id',$portfolioId)->first();

      $portfolio->is_sold_stock = TRUE;
      $portfolio->sold_price = $portfolio->stock->future_price;
      $portfolio->save();

    }catch(Throwable $th){
      $status = 500;
      $message = NULL;
    }
    return response()->json(compact('message', 'status'), $status);
  }
}
