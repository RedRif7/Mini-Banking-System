<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\Http;

class CryptoService
{
    protected $apikey;
    public function __construct()
    {
        $this->apiKey = env('COINMARKETCAP_API_KEY');
    }
    public function makeApiCall(string $url,array $params = [])
    {
        return Http::withHeaders([
            'X-CMC_PRO_API_KEY' => $this->apiKey,
        ])->get($url, $params);
    }
}
