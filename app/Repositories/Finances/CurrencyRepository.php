<?php


namespace App\Repositories\Finances;


use App\Collections\Finances\Currency\CurrencyCollection;
use App\Collections\Finances\Currency\CurrencyCollectionItem;
use App\Interfaces\Repositories\Finances\CurrencyRepositoryInterface;
use App\Models\Finances\Currency\Currency;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class CurrencyRepository implements CurrencyRepositoryInterface
{

    public function all(): Collection
    {
        return Currency::all();
    }

    public function get(int $id): Model|null
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

    public function create(array $data): Model
    {
        return Currency::query()->create($data);
    }
}
