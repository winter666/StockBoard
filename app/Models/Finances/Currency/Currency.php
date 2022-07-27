<?php

namespace App\Models\Finances\Currency;

use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    protected $fillable = [
        'number_code',
        'char_code',
        'external_id',
        'name',
        'nominal',
        'value',
    ];
}
