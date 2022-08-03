<?php


namespace App\Services\API\Finances\Currency;


use App\Services\API\AbstractAPI;
use Psr\Http\Message\ResponseInterface;

class BlockchainAPI extends AbstractAPI
{
    protected string $api_uri = 'https://blockchain.info/';
    protected string $name = 'Blockchain Currency';

    public function ticker(): ResponseInterface
    {
        return $this->get('ticker');
    }

    public function toBTC(string $currency, float|int $value): ResponseInterface
    {
        return $this->get("tobtc?currency={$currency}&value={$value}");
    }
}
