<x-app-layout>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3><strong>{{$crypto['symbol']}}</strong></h3>
                    <li>
                    PRICE - {{ Auth::user()->currency }} {{number_format($crypto['price'],2)}}
                    </li>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
