<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CurrenciesController extends Controller
{
    public static function all():array
    {
        return [
            'EUR', // Euro
            'AUD', // Australian Dollar
            'BGN', // Bulgarian Lev
            'BRL', // Brazilian Real
            'CAD', // Canadian Dollar
            'CHF', // Swiss Franc
            'CNY', // Chinese Yuan
            'CZK', // Czech Koruna
            'DKK', // Danish Krone
            'GBP', // British Pound Sterling
            'HKD', // Hong Kong Dollar
            'HUF', // Hungarian Forint
            'IDR', // Indonesian Rupiah
            'ILS', // Israeli New Shekel
            'INR', // Indian Rupee
            'ISK', // Icelandic Króna
            'JPY', // Japanese Yen
            'KRW', // South Korean Won
            'MXN', // Mexican Peso
            'MYR', // Malaysian Ringgit
            'NOK', // Norwegian Krone
            'NZD', // New Zealand Dollar
            'PHP', // Philippine Peso
            'PLN', // Polish Zloty
            'RON', // Romanian Leu
            'SEK', // Swedish Krona
            'SGD', // Singapore Dollar
            'THB', // Thai Baht
            'TRY', // Turkish Lira
            'USD', // United States Dollar
            'ZAR'  // South African Rand
        ];
    }
}
