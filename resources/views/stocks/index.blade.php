<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
      {{ __('Stocks') }}
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
                  <th scope="col" class="px-6 py-3">
                    Symbol
                  </th>
                  <th scope="col" class="px-6 py-3">
                    Market Cap
                  </th>
                  <th scope="col" class="px-6 py-3">
                    Price (₹)
                  </th>
                  <th scope="col" class="px-6 py-3 text-end">
                    Action
                  </th>
                </tr>
              </thead>
              <tbody>
                @foreach($stocks as $stock)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                  <td class="px-6 py-4">{{ $stock->symbol }}</td>
                  <td class="px-6 py-4">{{ config('stockmaster.marketCapCategory.'.$stock->marketCapCategory->name) }}</td>
                  <td class="px-6 py-4">{{ $stock->price }}</td>
                  <td class="px-6 py-4 text-end">
                    <button type="button" onclick="openModal('{{ $stock->symbol }}')" class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 focus:outline-none dark:focus:ring-green-800">BUY</button>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>

  @include('stocks.partials.buy-stock-modal')
  <x-slot name="scripts">
    <script>
      function openModal(symbol) {
        $('#quantity').val('');
        $('#buy-stock-modal').removeClass('invisible');
        $('#buy-stock-modal-title').text(symbol);
        $('#stock_symbol').val(symbol);
        $('#errorMessages').empty();
      }

      $('.close-modal').on('click', function(e) {
        $('#buy-stock-modal').addClass('invisible');
      });

      $('#quantity').keyup(function (){
        $('#errorMessages').empty();
      })

      $('#buy-stock-form').submit(function(e) {
        e.preventDefault();
        $.ajax({
          type: 'POST',
          url: '/buy-stock',
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          data: $('#buy-stock-form').serialize(),
          success: function(response) {
            $('#errorMessages').empty();
            $('#buy-stock-modal').addClass('invisible');
            alert(response.message);
          },
          error: function(xhr, status, error) {
              $('#errorMessages').empty();
              if(xhr.responseJSON.message != null){
                var errors = xhr.responseJSON.errors;
                $.each(errors, function(key, value) {
                    $('#errorMessages').append('<p class="text-red-600 mt-2">' + value + '</p>');
                });
              }else{
                $('#errorMessages').append('<p class="text-red-600 mt-2">Something went wrong.</p>');
              }
          }
        });
      });
    </script>
  </x-slot>
</x-app-layout>