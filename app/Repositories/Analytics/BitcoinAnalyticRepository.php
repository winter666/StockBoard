<?php


namespace App\Repositories\Analytics;


use App\Interfaces\Repositories\Analytics\BitcoinAnalyticRepositoryInterface;
use App\Models\Analytics\BitcoinCurrencyAnalytics;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class BitcoinAnalyticRepository implements BitcoinAnalyticRepositoryInterface
{

    public function all(): Collection
    {
        return BitcoinCurrencyAnalytics::all();
    }

    public function get(int $id): Model|null
    {
        return BitcoinCurrencyAnalytics::query()->find($id);
    }

    public function getOrderLatest(): Collection {
        return BitcoinCurrencyAnalytics::query()
            ->orderBy('created_at')
            ->get();
    }

    public function create(array $data): Model
    {
       return BitcoinCurrencyAnalytics::query()->create($data);
    }
}
