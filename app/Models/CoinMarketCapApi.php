<?php

namespace App\Models;

use App\Http\Controllers\CryptoImageController;
use Dotenv\Dotenv;
use GuzzleHttp\Client;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;

class CoinMarketCapApi
{
    private Client $client;
    private string $apiKey;
    private string $urlTop;
    private string $urlInfo;

    public function __construct()
    {

        $this->client = new Client();
        $this->apiKey = '868535e9-2644-4b1e-9209-3363a0da0dd0';
        $this->urlTop = 'https://pro-api.coinmarketcap.com/v1/cryptocurrency/listings/latest';
        $this->urlInfo = 'https://pro-api.coinmarketcap.com/v2/cryptocurrency/info';
    }
    public function makeCall(string $url, array $params=[])
    {
        return Http::withHeaders([
            'X-CMC_PRO_API_KEY' => $this->apiKey,
        ])->get($url,$params);
    }

    public function getCryptoPrice(string $symbol): float
    {
        $cryptos = $this->getTopCryptos();
        foreach ($cryptos as $crypto) {
            if ($crypto['symbol'] === $symbol) {
                return $crypto['price'];
            }
        }
        return 0.0;
    }

    public function getTopCryptos(): array
    {
        $response = Http::withHeaders([
                'X-CMC_PRO_API_KEY' => $this->apiKey,
            ])->get($this->urlTop,[
                'start' => 1,
                'limit' => 100,
                'convert' => 'USD'
            ]);

        $data = $response->json();
        $symbols = [];
        $cryptos = [];
        foreach ($data['data'] as $crypto) {
            $cryptos[] = [
                'id' => $crypto['id'],
                'name' => $crypto['name'],
                'symbol' => $crypto['symbol'],
                'price' => $crypto['quote']['USD']['price']
            ];
            $symbols[] = $crypto['symbol'];
        }

        return $cryptos;
    }

    public function getCryptoBySymbol(string $symbol, array $cryptos)
    {
        foreach ($cryptos as $crypto) {
            if ($crypto['symbol'] === $symbol) {
                return $crypto;
            }
        }
        return null;
    }
    public function getImage()
    {
       ;

    }

}
