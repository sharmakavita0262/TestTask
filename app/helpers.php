<?php
function calculateProfitLoss($purchasePrice, $sellingPrice, $quantity, $taxPercentage, $totalValue = FALSE)
{
  $profitPerItem = $sellingPrice - $purchasePrice;

  $totalProfitBeforeTax = $totalProfitAfterTax = $profitPerItem * $quantity;

  $taxAmount = ($taxPercentage / 100) * $profitPerItem * $quantity;

  $totalInvestment = $purchasePrice * $quantity;

  if($totalProfitAfterTax > 0){
    $totalProfitAfterTax = $totalProfitBeforeTax - $taxAmount;
  }

  $percentageProfitAfterTax = ($totalProfitAfterTax / $totalInvestment) * 100;
  if($totalValue){
    return $totalProfitAfterTax;
  }
  if($percentageProfitAfterTax > 0){
    return '<span class="text-green-600">+'. number_format($percentageProfitAfterTax,2).'% </span>';
  }
  return '<span class="text-red-600">'. number_format($percentageProfitAfterTax,2).'% </span>';
}
