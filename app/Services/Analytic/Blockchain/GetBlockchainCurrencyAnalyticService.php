<?php


namespace App\Services\Analytic\Blockchain;


use App\Interfaces\IService;
use App\Repositories\Analytics\BitcoinAnalyticRepository;
use Illuminate\Database\Eloquent\Collection;

class GetBlockchainCurrencyAnalyticService implements IService
{
    private BitcoinAnalyticRepository $bitcoin_analytic_repository;

    public function __construct()
    {
        $this->bitcoin_analytic_repository = new BitcoinAnalyticRepository();
    }

    public function run()
    {
        $rawAnalytics = $this->bitcoin_analytic_repository->getOrderLatest();
        $values = $rawAnalytics->sortByDesc('buy_value')->pluck('buy_value')->unique()->values()->all();
        $dates = $rawAnalytics
            ->sortBy('created_at')
            ->pluck('created_at')
            ->map(fn($carbonItem) => ($carbonItem->format('Y-m-d H:i')))
            ->unique()->values()->all();
        $analytics = $rawAnalytics->groupBy('char_code')
            ->map(fn (Collection $collection) => ($collection->sortBy('created_at')->pluck('buy_value')))
            ->toArray();
        $legend = array_keys($analytics);
        return compact('values', 'dates', 'analytics',  'legend');
    }
}
