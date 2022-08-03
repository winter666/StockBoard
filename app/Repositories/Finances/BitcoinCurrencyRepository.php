<?php


namespace App\Repositories\Finances;


use App\Interfaces\Repositories\Finances\BitcoinCurrencyRepositoryInterface;
use App\Models\Finances\Currency\BitcoinCurrency;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class BitcoinCurrencyRepository implements BitcoinCurrencyRepositoryInterface
{

    public function all(): Collection
    {
        return BitcoinCurrency::all();
    }

    public function get(int $id): Model|null
    {
        return BitcoinCurrency::query()->find($id);
    }

    public function updateOrCreate(array $needle, array $data): Model
    {
        return BitcoinCurrency::query()->updateOrCreate($needle, $data);
    }

    public function create(array $data): Model
    {
        return BitcoinCurrency::query()->create($data);
    }
}
