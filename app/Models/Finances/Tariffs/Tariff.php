<?php

namespace App\Models\Finances\Tariffs;

use Illuminate\Database\Eloquent\Model;

class Tariff extends Model
{
    protected $fillable = [
        'name',
        'description',
        'attributes',
        'price',
        'time',
    ];
}
