<?php

namespace App\Models\API;

use Illuminate\Database\Eloquent\Model;

class Syncronization extends Model
{
    protected $fillable = [
        'name', 'status',
    ];

    public const STATUS_COMPLETED = 'COMPLETED';
    public const STATUS_IN_PROGRESS = 'IN_PROGRESS';
    public const STATUS_FAILED = 'FAILED';
}
