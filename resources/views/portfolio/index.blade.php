<x-app-layout>
  <x-slot name="header">
    <div class="flex justify-between">
      <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        {{ __('Portfolio') }}
      </h2>
      <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        Total Profit: ₹{{ number_format($totalProfit,2)}}
      </h2>
    </div>
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
                  <th scope="col" class="px-6 py-3">Action</th>
                </tr>
              </thead>
              <tbody>
                @if(!$portfolio->isEmpty())
                @foreach($portfolio as $data)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700" id="{{  'portfolio_row_'.$data->id }}">
                  <td class="px-6 py-4">{{ $data->stock->symbol }}</td>
                  <td class="px-6 py-4">{{ config('stockmaster.marketCapCategory.'.$data->stock->marketCapCategory->name) }}</td>
                  <td class="px-6 py-4">{{ $data->quantity }}</td>
                  <td class="px-6 py-4">{{ $data->price }}</td>
                  <td class="px-6 py-4">{{ $data->stock->future_price }}</td>
                  <td class="px-6 py-4">
                    {!! calculateProfitLoss($data->price, $data->stock->future_price, $data->quantity, $data->stock->marketCapCategory->tax_rate) !!}
                  </td>
                  <td class="px-6 py-4">
                    <button type="button" onclick="openModal('{{ $data->stock->symbol }}', '{{  $data->id }}')" class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 focus:outline-none dark:focus:ring-red-800">SELL</button>
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

  @include('portfolio.partials.sell-stock-modal')
  <x-slot name="scripts">
    <script>
      function openModal(symbol,portfolioId) {
        $('#sell-stock-modal').removeClass('invisible');
        $('#sell-stock-modal-title').text(symbol);
        $('#stock_symbol').val(symbol);
        $('#portfolio_id').val(portfolioId);
      }

      $('.close-modal').on('click', function(e) {
        $('#sell-stock-modal').addClass('invisible');
      });

      $('#sell-stock-button').click(function() {
        $.ajax({
          type: 'POST',
          url: '/sell-stock',
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          data: $('#sell-stock-form').serialize(),
          success: function(response) {
            $('#sell-stock-modal').addClass('invisible');
            let portfolioId = $('#portfolio_id').val();
            $('#portfolio_row_'+portfolioId).remove();
            alert(response.message);
          },
          error: function(error) {
            console.log(error);
            alert('Something went wrong');
          }
        });
      });
    </script>
  </x-slot>
</x-app-layout>