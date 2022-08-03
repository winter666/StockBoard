<?php


namespace App\Interfaces\Repositories\Finances;


use App\Collections\Finances\Currency\CurrencyCollection;
use App\Interfaces\Repositories\ModelRepository;

interface CurrencyRepositoryInterface extends ModelRepository
{
    public function getByExternalId(string $id);

    public function sync(CurrencyCollection $collection);
}
