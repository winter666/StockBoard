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

    public function storeOnceADay(array $needle, array $data)
    {
        $b = BitcoinCurrencyAnalytics::query()->where($needle)->first();
        if (!is_null($b)) {
            $isDifference = Carbon::parse($b->created_at)
                ->diffInDays(now());
            if ($isDifference >= 1) {
                $this->create($data);
            }
        } else {
            $this->create($data);
        }
    }

    public function graphFormat(): array {
        $rawAnalytics = BitcoinCurrencyAnalytics::query()->orderBy('created_at')->get();
        $values = $rawAnalytics->sortByDesc('buy_value')->pluck('buy_value')->unique()->values()->all();
        $dates = $rawAnalytics
            ->sortBy('created_at')
            ->pluck('created_at')
            ->map(fn($carbonItem) => ($carbonItem->format('Y-m-d')))
            ->unique()->values()->all();
        $analytics = $rawAnalytics->groupBy('char_code')
            ->map(fn (\Illuminate\Database\Eloquent\Collection $collection) => ($collection->sortBy('created_at')->pluck('buy_value')))
            ->toArray();
        $legend = array_keys($analytics);
        return compact('values', 'dates', 'analytics',  'legend');
    }

    public function create(array $data): Model
    {
       return BitcoinCurrencyAnalytics::query()->create($data);
    }
}
