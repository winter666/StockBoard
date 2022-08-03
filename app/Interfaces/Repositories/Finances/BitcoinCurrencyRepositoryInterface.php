<?php


namespace App\Interfaces\Repositories\Finances;


use App\Interfaces\Repositories\ModelRepository;
use Illuminate\Database\Eloquent\Model;

interface BitcoinCurrencyRepositoryInterface extends ModelRepository
{
    public function updateOrCreate(array $needle, array $data): Model;
}
