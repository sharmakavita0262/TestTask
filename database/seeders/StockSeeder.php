<?php

namespace Database\Seeders;

use App\Models\Stock;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StockSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    $stocks = [
      ['symbol' => 'SHEETAL', 'market_cap_category_id' => 1, 'price' => 50, 'future_price' => 70],
      ['symbol' => 'DRSDILIP', 'market_cap_category_id' => 2, 'price' => 250, 'future_price' => 230],
      ['symbol' => 'NIRAJISPAT', 'market_cap_category_id' => 3, 'price' => 800, 'future_price' => 1400],
    ];

    foreach ($stocks as $stock) {
      Stock::updateOrCreate(
        ['symbol' => $stock['symbol']],
        $stock
      );
    }
  }
}
