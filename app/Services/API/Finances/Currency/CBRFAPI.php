<?php


namespace App\Services\API\Finances\Currency;


use App\Services\API\AbstractAPI;

class CBRFAPI extends AbstractAPI
{
    protected string $api_uri = 'https://www.cbr-xml-daily.ru/';

    public function getDailyCurrency(): \Psr\Http\Message\ResponseInterface
    {
        return $this->client->get('daily.xml');
    }
}
