<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Clients\ClientStoreFormRequest;
use App\Http\Resources\Admin\Clients\ClientResource;
use App\Models\Clients\Client;
use App\Repositories\Clients\ClientRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class ClientController extends Controller
{

    public function index(Request $request, ClientRepository $clientRepository)
    {
        $limit = $request->get('limit');
        return ClientResource::collection($clientRepository->paginateOrderByIdDesc($limit));
    }

    public function store(ClientStoreFormRequest $request): JsonResponse|ClientResource
    {
        try {
            $data = $request->all();
            $data['password'] = Hash::make($data['password']);
            $client = Client::query()->create($data);
            return ClientResource::make($client);
        } catch (\Exception $e) {
            Log::debug($e->getMessage(), $e->getTrace());
            return json_error();
        }
    }

    public function show($id)
    {
        try {
            $client = Client::query()->find($id);
            return ClientResource::make($client);
        } catch (ModelNotFoundException $e) {
            return json_error(404);
        } catch (\Exception $e) {
            Log::debug($e->getMessage(), $e->getTrace());
            return json_error();
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $data = $request->all();
            $client = Client::query()->findOrFail($id);
            $client->update($data);
            return ClientResource::make($client);
        } catch (ModelNotFoundException $e) {
            return json_error(404);
        } catch (\Exception $e) {
            Log::debug($e->getMessage(), $e->getTrace());
            return json_error();
        }
    }

    public function destroy($id)
    {
        try {
            Client::destroy([$id]);
            return response()->json([], 204);
        } catch (ModelNotFoundException $e) {
            return json_error(404);
        } catch (\Exception $e) {
            Log::debug($e->getMessage(), $e->getTrace());
            return json_error();
        }
    }
}
