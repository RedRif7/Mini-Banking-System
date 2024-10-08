<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Crypto extends Model
{
    use HasFactory;


    protected $table = 'cryptos';
    protected $fillable = [
        'crypto_id',
        'name',
        'symbol',
        'price',
    ];
}
