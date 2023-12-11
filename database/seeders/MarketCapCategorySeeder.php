<?php

namespace Database\Seeders;

use App\Models\MarketCapCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MarketCapCategorySeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    $categories = [
      ['name' => 's', 'tax_rate' => '25'],
      ['name' => 'm', 'tax_rate' => '20'],
      ['name' => 'l', 'tax_rate' => '15'],
    ];

    foreach ($categories as $category) {
      MarketCapCategory::updateOrCreate(
        ['name' => $category['name']],
        $category
      );
    }
  }
}
