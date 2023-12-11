<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
  public function index(Request $request)
  {
      $user = $request->user();
      $portfolio = Portfolio::where('user_id',$user->id)->get();
      return view('portfolio.index')->with(compact('portfolio'));
  }
}
