<?php
function calculateProfitLoss($purchasePrice, $sellingPrice, $quantity, $taxPercentage)
{
  $profitPerItem = $sellingPrice - $purchasePrice;

  $totalProfitBeforeTax = $profitPerItem * $quantity;

  $taxAmount = ($taxPercentage / 100) * $profitPerItem * $quantity;

  $totalInvestment = $purchasePrice * $quantity;

  $totalProfitAfterTax = $totalProfitBeforeTax - $taxAmount;

  $percentageProfitAfterTax = ($totalProfitAfterTax / $totalInvestment) * 100;
  if($percentageProfitAfterTax > 0){
    return '<span class="text-green-600">'. $percentageProfitAfterTax.'% </span>';
  }
  return '<span class="text-red-600">'. $percentageProfitAfterTax.'% </span>';
}
