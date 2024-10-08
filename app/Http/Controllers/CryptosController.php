<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCryptosRequest;
use App\Http\Requests\UpdateCryptosRequest;
use App\Http\Services\CryptoService;
use App\Models\Crypto;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;


class CryptosController extends Controller
{
    protected $cryptoService;
    public function __construct(CryptoService $cryptoService){
        $this->cryptoService = $cryptoService;
    }
    public function index()
    {
        $user = Auth::user();

        // Retrieve the user's preferred currency from the database
        $currency = $user && $user->currency ? $user->currency : 'USD';

        // Parameters for API call
        $params = [
            'start' => 1,
            'limit' => 100,
            'convert' => $currency
        ];

        // API URL
        $url = 'https://pro-api.coinmarketcap.com/v1/cryptocurrency/listings/latest';

        // Make API call
        $response = $this->cryptoService->makeApiCall($url, $params);

        // Check if the API response is successful
        if ($response->successful()) {
            $cryptosData = $response->json()['data'];

            // Extract the data for bulk insert/update
            $cryptosToUpdate = [];

            foreach ($cryptosData as $crypto) {
                $cryptosToUpdate[] = [
                    'crypto_id' => $crypto['id'],
                    'name' => $crypto['name'],
                    'symbol' => $crypto['symbol'],
                    'price' => $crypto['quote'][$currency]['price'], // Use dynamic currency
                    'updated_at' => now(), // Required for `updateOrCreate`
                ];
            }

            // Use batch update or insert
            Crypto::upsert($cryptosToUpdate, ['crypto_id'], ['name', 'symbol', 'price']);

        } else {
            // Handle API call failure
            return view('cryptos', ['error' => 'Unable to fetch cryptocurrency data.']);
        }

        // Retrieve the updated list of cryptos from the database
        $cryptos = Crypto::all();

        // Return the view with the updated cryptocurrency data
        return view('cryptos', ['cryptos' => $cryptos]);
    }
    /**
     * Show the form for creating a new resource.
     */
    public static function coinBySymbol(string $symbol)
    {
        $cryptos = Crypto::all();
        foreach ($cryptos as $crypto) {
            if ($crypto['symbol'] === $symbol) {
                return $crypto;
            }
        }
        return null;
    }
    public function showDetails(Request $request)
    {
        $symbol = $request->query('symbol');
        $crypto = Crypto::where('symbol', $symbol)->first();

        if ($crypto) {
            $user = Auth::user();

            $selectedCrypto = [
                'symbol' => $crypto->symbol,
                'price' => $crypto->price,
            ];

            return view('cryptos', [
                'cryptos' => ['data' => Crypto::all()],
                'selectedCrypto' => $selectedCrypto,
                'user' => $user,
            ]);
        } else {
            return redirect()->back()->with('error', 'Crypto not found');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCryptosRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($symbol)
    {
        $crypto = Crypto::where('symbol', $symbol)->first();

        // Check if the crypto exists
        if (!$crypto) {
            return redirect()->route('cryptos')->with('error', 'Cryptocurrency not found.');
        }

        // Return the view with the selected crypto
        return view('crypto', ['crypto' => $crypto]);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Crypto $cryptos)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCryptosRequest $request, Crypto $cryptos)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Crypto $cryptos)
    {
        //
    }
}
