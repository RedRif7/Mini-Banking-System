<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CryptoImage extends Model
{
    use HasFactory;

    protected $table = 'crypto_symbol_image';
    protected $fillable = ['symbol','image'];
    public $timestamps = false;

}
