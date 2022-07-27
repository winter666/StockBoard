<?php

namespace App\Console\Commands\Finances\Currency;

use App\Collections\Finances\Currency\CurrencyCollection;
use App\Repositories\Finances\CurrencyRepository;
use App\Services\API\Finances\Currency\CBRFAPI;
use Illuminate\Console\Command;

class SyncCBRFCommand extends Command
{
    protected $signature = 'currency:sync';
    protected $description = 'Command for sync currency from CBRF';
    protected CBRFAPI $api;

    public function __construct()
    {
        parent::__construct();
        $this->api = new CBRFAPI();
    }

    public function handle(CurrencyRepository $currencyRepository)
    {
        $responseBody = $this->api
            ->getDailyCurrency()
            ->getBody();

        $simpleXML = new \SimpleXMLElement($responseBody);
        $currencies = [];
        foreach ($simpleXML as $xml) {
            $currencies[] = [
                'number_code' => $xml->NumCode->__toString(),
                'char_code' => $xml->CharCode->__toString(),
                'external_id' => $xml->attributes()->__toString(),
                'name' => $xml->Name->__toString(),
                'nominal' => (double) $xml->Nominal->__toString(),
                'value' => (double) $xml->Value->__toString(),
            ];

        }

        $collection = new CurrencyCollection($currencies);
        $currencyRepository->sync($collection);

        return 0;
    }
}
