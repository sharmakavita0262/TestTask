<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
  public function index(Request $request)
  {
      $user = $request->user();
      $portfolio = Portfolio::where(['user_id' => $user->id, 'is_sold_stock' => FALSE])->get();

      $totalProfit = 0;
      foreach ($portfolio as $data) {
          $totalProfit += calculateProfitLoss($data->price, $data->stock->future_price, $data->quantity, $data->stock->marketCapCategory->tax_rate,TRUE);
      }

      return view('portfolio.index')->with(compact('portfolio','totalProfit'));
  }
  public function soldStocks(Request $request)
  {
      $user = $request->user();
      $portfolio = Portfolio::where(['user_id' => $user->id, 'is_sold_stock' => TRUE])->get();
      return view('portfolio.sold-stocks')->with(compact('portfolio'));
  }
}
