<?php

namespace App\Models\Analytics;

use Illuminate\Database\Eloquent\Model;

class BitcoinCurrencyAnalytics extends Model
{
    protected $fillable = [
        'char_code',
        'last_value',
        'buy_value',
        'sell_value',
    ];
}
