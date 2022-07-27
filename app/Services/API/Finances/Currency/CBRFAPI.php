<?php


namespace App\Services\API\Finances\Currency;


use App\Services\API\AbstractAPI;

class CBRFAPI extends AbstractAPI
{
    protected string $api_uri = 'https://www.cbr-xml-daily.ru/';
    protected string $name = 'CBRF Currency';

    public function getDailyCurrency(): \Psr\Http\Message\ResponseInterface
    {
        return $this->get('daily.xml');
    }
}
