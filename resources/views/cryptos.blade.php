<x-app-layout>

    <style>
        /* Custom styles for scrollable table */
        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }
        .scrollable-table-container {
            max-height: 600px; /* Set a fixed height for the table container */
            overflow-y: auto; /* Enable vertical scrolling */

        }

        .scrollable-table {
            width: 100%; /* Full width for the table */
            table-layout: fixed; /* Enables fixed table layout for equal column widths */
            border-collapse: collapse;
        }

        .scrollable-table th,
        .scrollable-table td {
            padding: 10px; /* Consistent padding */
            white-space: nowrap; /* Prevent text from wrapping */
            overflow: hidden; /* Hide overflow text */
            text-overflow: ellipsis; /* Add ellipsis for overflowing text */
        }
    </style>
    <section id="cryptos">
    <h2 class="text-3xl font-bold text-center mt-8 mb-4  text-[#b9c9b8]">Top Cryptocurrencies</h2>
        <h2 class="text-3xl font-bold text-left ml-52 text-[#b9c9b8]">SEARCH</h2>
        <div class="flex p-4 box-border container mx-auto flex space-x-4">
        <div class="no-scrollbar scrollable-table-container w-1/2 border border-gray-300 shadow-xl rounded-lg">
            <table class="scrollable-table border-b-2 w-1/2 bg-[#222d3d] shadow-2xl rounded-xl">
                <thead class="bg-blue-gray-100 border-b-2 sticky border-[#dc9a35] text-[#b9c9b8]">
                <tr>
                    <th class="py-3 px-4 text-left">ID</th>
                    <th class="py-3 px-4 text-left">Name</th>
                    <th class="py-3 px-4 text-left">Symbol</th>
                    <th class="py-3 px-4 text-left">Price</th>
                    <th class="py-3 px-4 text-center">Action</th>
                </tr>
                </thead>
                @foreach($cryptos as $crypto)
                <tbody class="text-[#b9c9b8]">
                <tr class="border-b border-blue-gray-200">
                    <td class="py-3 px-4">{{$crypto['crypto_id']}}</td>
                    <td class="py-3 px-4"><strong>{{$crypto['name']}}</strong></td>
                    <td class="py-3 px-4 ">{{$crypto['symbol']}}</td>
                    <td class="py-3 px-4 ">{{Auth::user()->currency }} {{number_format($crypto['price'],6)}}</td>
                    <td class="py-3 px-4 text-center">
                        <form action="{{ route('cryptos.details') }}" method="GET">
                            <input type="hidden" name="symbol" value="{{ $crypto['symbol'] }}">
                            <button type="submit">Check</button>
                        </form>
                    </td>
                </tr>
                </tbody>
                @endforeach
            </table>
        </div>
            <div class="w-1/2 bg-[#222d3d] shadow-xl rounded-lg ps-5 border border-gray-300 text-[#b9c9b8]">

                @if(isset($selectedCrypto))
                    <h2 class="text-lg font-bold mb-4 text-center p-6">Crypto Details</h2>
                    <div id="crypto-details">
                        <p><strong>IBAN:</strong> <span id="user-iban">{{ $user->iban }}</span></p>
                        <p><strong>Symbol:</strong> <span id="crypto-symbol">{{ $selectedCrypto['symbol'] }}</span></p>
                        <p><strong>Price:</strong> $<span id="crypto-price">{{ number_format($selectedCrypto['price'], 6) }}</span></p>
                        <p><strong>Balance:</strong> $<span id="user-balance">{{ number_format($user->balance, 2) }}</span></p>
                    </div>
                @else
                    <p class="text-center text-[#b9c9b8] text-2xl p-32">No crypto selected. Please click "Check" to view details.</p>
                @endif
            </div>
        </div>
    </section>
    <footer>
            <h2 class="text-sm font-bold text-center mt-4 text-[#b9c9b8]">Coin data from CoinMarketAPI</h2>
    </footer>
</x-app-layout>
