<?php


namespace App\Services\API;


use App\Exceptions\FailedSyncException;
use App\Models\API\Syncronization;
use App\Repositories\API\SyncronizationRepository;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Support\Facades\Log;

abstract class AbstractAPI
{
    protected string $api_uri;
    protected array $headers = [];
    protected Client $client;
    protected string $name;
    private Syncronization $sync;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => $this->api_uri,
            'headers' => $this->headers,
        ]);
    }

    public function get(string $uri): \Psr\Http\Message\ResponseInterface {
        /**
         * @var Syncronization $sync
         */
        $syncRepository = new SyncronizationRepository();
        $sync = $syncRepository->create([
            'name' => $this->name,
            'status' => 'IN_PROGRESS',
        ]);
        $this->sync = $sync;
        try {
            $response = $this->client->get($uri);
            $sync->update(['status' => 'COMPLETED']);
            return $response;
        } catch(ClientException $e) {
            $sync->update(['status' => 'FAILED']);
            Log::debug($e->getMessage(), $e->getTrace());
            throw new FailedSyncException("Sync {$this->name} Failed");
        }
    }
}
