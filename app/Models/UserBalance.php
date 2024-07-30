<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserBalance
{
    use HasFactory;
    public float $balance;

    public function __construct(float $balance)
    {
        $this->balance = $balance;
    }
    public function getBalance(): float
    {
        return $this->balance;
    }
}
