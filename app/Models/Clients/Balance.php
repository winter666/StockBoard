<?php

namespace App\Models\Clients;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Balance extends Model
{
    protected $fillable = [
        'type',
        'value',
        'client_id',
    ];

    const TYPE_RUB = 'RUB';
    const TYPE_USD = 'USD';
    const TYPES = [
        self::TYPE_RUB,
        self::TYPE_USD,
    ];

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }
}
