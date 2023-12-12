<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
      {{ __('Sold Stocks') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900 dark:text-gray-100">
          <div class="relative overflow-x-auto">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
              <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                  <th scope="col" class="px-6 py-3">Symbol</th>
                  <th scope="col" class="px-6 py-3">Market Cap</th>
                  <th scope="col" class="px-6 py-3">Quantity</th>
                  <th scope="col" class="px-6 py-3">Buy Price (₹)</th>
                  <th scope="col" class="px-6 py-3">Latest Price (₹)</th>
                  <th scope="col" class="px-6 py-3">Profit/Loss</th>
                </tr>
              </thead>
              <tbody>
                @if(!$portfolio->isEmpty())
                @foreach($portfolio as $data)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                  <td class="px-6 py-4">{{ $data->stock->symbol }}</td>
                  <td class="px-6 py-4">{{ config('stockmaster.marketCapCategory.'.$data->stock->marketCapCategory->name) }}</td>
                  <td class="px-6 py-4">{{ $data->quantity }}</td>
                  <td class="px-6 py-4">{{ $data->price }}</td>
                  <td class="px-6 py-4">{{ $data->sold_price }}</td>
                  <td class="px-6 py-4">
                    {!! calculateProfitLoss($data->price, $data->sold_price, $data->quantity, $data->stock->marketCapCategory->tax_rate) !!}
                  </td>
                </tr>
                @endforeach
                @else
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                  <td class="px-6 py-4" colspan="7">No Stocks Found</td>
                </tr>
                @endif
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>

</x-app-layout>