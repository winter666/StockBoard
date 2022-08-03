<?php

namespace App\Console\Commands\Finances\Currency;

use App\Repositories\Finances\BitcoinCurrencyRepository;
use App\Services\API\Finances\Currency\BlockchainAPI;
use Illuminate\Console\Command;

class SyncBlockchainCommand extends Command
{

    protected $signature = 'currency:blockchain';
    protected $description = 'Command for sync blockchain currency';
    protected BlockchainAPI $api;

    public function __construct()
    {
        parent::__construct();
        $this->api = new BlockchainAPI();
    }

    public function handle(BitcoinCurrencyRepository $bitcoinCurrencyRepository)
    {
        $tickerResponseBody = json_decode($this->api
            ->ticker()
            ->getBody());

        foreach ($tickerResponseBody as $key => $tick) {
            $data = [
                'char_code' => $tick->symbol,
                'last_value' => $tick->last,
                'buy_value' => $tick->buy,
                'sell_value' => $tick->sell,
            ];

            $bitcoinCurrencyRepository->updateOrCreate(['char_code' => $data['char_code']], $data);
        }

        return 0;
    }
}
