<?php


namespace App\Interfaces\Finances;


use App\Collections\Finances\Currency\CurrencyCollection;

interface CurrencyRepositoryInterface
{
    public function all();

    public function get(int $id);

    public function getByExternalId(string $id);

    public function sync(CurrencyCollection $collection);
}
