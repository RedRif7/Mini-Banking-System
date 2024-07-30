<?php

namespace App\Http\Controllers;

use App\Http\Services\CryptoService;
use App\Models\CryptoImage;
use Illuminate\Http\Request;

class CryptoImageController extends Controller
{
    protected $cryptoService;
    public function __construct(CryptoService $cryptoService){
        $this->cryptoService = $cryptoService;
    }
    public function index(array $symbols)
    {
        $params = [
            'start'=>1,
            'limit'=>100,
        ];

        $url = 'https://pro-api.coinmarketcap.com/v2/cryptocurrency/info';

        $response = $this->cryptoService->makeApiCall($url,$params);
        $cryptos = $response->json()['data'];
        if($response->successful()){
            return $response->json();
        }else{
            return response()->json(['error' => 'Failed to fetch data'], 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(CryptoImage $cryptoImage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CryptoImage $cryptoImage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CryptoImage $cryptoImage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CryptoImage $cryptoImage)
    {
        //
    }
}
