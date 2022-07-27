<?php


namespace App\Services\API;


use GuzzleHttp\Client;

abstract class AbstractAPI
{
    protected string $api_uri;
    protected array $headers = [];
    protected Client $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => $this->api_uri,
            'headers' => $this->headers,
        ]);
    }
}
