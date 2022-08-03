<?php

namespace App\Models\Finances\Currency;

use Illuminate\Database\Eloquent\Model;

class BitcoinCurrency extends Model
{
    protected $fillable = [
        'char_code',
        'last_value',
        'buy_value',
        'sell_value',
    ];
}
