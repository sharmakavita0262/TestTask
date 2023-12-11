<div id="buy-stock-modal" class="relative z-10 invisible" aria-labelledby="modal-title" role="dialog" aria-modal="true">
  <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
  <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
    <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
      <div class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
        <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4 border-y">
          <h3>BUY <span id="buy-stock-modal-title"></span> STOCKS</h3>
        </div>
        <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
          <form class="px-8 pt-6 pb-8 mb-4" id="buy-stock-form" method="post">
            <div class="mb-4">
              <label class="block text-gray-700 text-sm font-bold mb-2" for="quantity">
                Quantity
              </label>
              <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="quantity" name="quantity" type="number" placeholder="Quantity">
              <input id="stock_symbol" name="stock_symbol" type="hidden" placeholder="Quantity">
            </div>
          </form>
        </div>
        <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
          <button type="button" id="buy-stock-button" class="inline-flex w-full justify-center rounded-md bg-green-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-green-500 sm:ml-3 sm:w-auto">BUY NOW</button>
          <button type="button" class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto close-modal">Cancel</button>
        </div>
      </div>
    </div>
  </div>
</div>