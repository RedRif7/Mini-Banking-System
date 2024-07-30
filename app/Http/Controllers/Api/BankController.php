<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Http;

class BankController extends Controller
{

    public static function all()
    {
        $xml = Http::get('https://www.bank.lv/vk/ecb.xml');
        if ($xml->successful())
        {
            $json = json_encode(simplexml_load_string($xml->body()));
            return json_decode($json,true);
        }
    }
}
