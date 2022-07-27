<?php


namespace App\Repositories\Finances;


use App\Collections\Finances\Currency\CurrencyCollection;
use App\Collections\Finances\Currency\CurrencyCollectionItem;
use App\Interfaces\Finances\CurrencyRepositoryInterface;
use App\Models\Finances\Currency\Currency;

class CurrencyRepository implements CurrencyRepositoryInterface
{

    public function all()
    {
        return Currency::all();
    }

    public function get(int $id)
    {
        return Currency::query()->find($id);
    }

    public function getByExternalId(string $id)
    {
        return Currency::query()->where('external_id', $id)->first();
    }

    public function sync(CurrencyCollection $collection)
    {
        /**
         * @var CurrencyCollectionItem $currency
         */
        foreach ($collection->get() as $currency) {
            Currency::query()->updateOrCreate([
                'external_id' => $currency->external_id,
            ], $currency->toArray());
        }
    }
}
