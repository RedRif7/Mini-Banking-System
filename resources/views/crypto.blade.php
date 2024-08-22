<x-app-layout>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3><strong>{{$crypto['symbol']}}</strong></h3>

                    <h2 class="text-3xl font-bold mt-8 mb-4 text-[#b9c9b8]">{{ $crypto->name }} ({{ $crypto->symbol }})</h2>

                    <div class="purchase-container border border-gray-300 shadow-xl rounded-lg p-4 bg-[#2a3b52] text-[#b9c9b8]">
                        <h2 class="text-2xl font-bold mb-4">Purchase {{ $crypto->name }}</h2>

                        <p><strong>Crypto:</strong> {{ $crypto->name }}</p>
                        <p><strong>Price per Unit:</strong> ${{ number_format($crypto->price, 2) }}</p>

{{--                        <form action="{{ route('cryptos.show') }}" method="POST">--}}
                            @csrf
                            <div class="form-group">
                                <label for="crypto-amount">Amount of Crypto:</label>
                                <input type="number" id="crypto-amount" name="crypto_amount" class="form-control" min="0.01" step="0.01" oninput="calculateTotal()">
                            </div>
                            <div class="form-group">
                                <label for="total-cost">Total Cost ($):</label>
                                <input type="text" id="total-cost" name="total_cost" class="form-control" readonly>
                            </div>
                            <div class="form-group">
                                <label for="cash-amount">Enter Cash Amount ($):</label>
                                <input type="number" id="cash-amount" name="cash_amount" class="form-control" min="0.01" step="0.01" oninput="calculateCryptoAmount()">
                            </div>
                            <button type="submit" class="btn-primary">Buy {{ $crypto->name }}</button>
                    </div>

                    <script>
                        function calculateTotal() {
                            const cryptoAmount = parseFloat(document.getElementById('crypto-amount').value) || 0;
                            const cryptoPrice = parseFloat('{{ $crypto->price ?? 0 }}');
                            const totalCost = (cryptoAmount * cryptoPrice).toFixed(2);
                            document.getElementById('total-cost').value = totalCost;
                        }

                        function calculateCryptoAmount() {
                            const cashAmount = parseFloat(document.getElementById('cash-amount').value) || 0;
                            const cryptoPrice = parseFloat('{{ $crypto->price ?? 0 }}');
                            const cryptoAmount = (cashAmount / cryptoPrice).toFixed(8);
                            document.getElementById('crypto-amount').value = cryptoAmount;
                            calculateTotal();
                        }
                    </script>
                    </html>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
