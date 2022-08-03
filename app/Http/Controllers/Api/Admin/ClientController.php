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

    public function store(ClientStoreFormRequest $request, ClientRepository $clientRepository): JsonResponse|ClientResource
    {
        try {
            $data = $request->all();
            $data['password'] = Hash::make($data['password']);
            $client = $clientRepository->create($data);
            return ClientResource::make($client);
        } catch (\Exception $e) {
            Log::debug($e->getMessage(), $e->getTrace());
            return json_error();
        }
    }

    public function show(ClientRepository $clientRepository, $id)
    {
        try {
            $client = $clientRepository->get($id);
            return ClientResource::make($client);
        } catch (ModelNotFoundException $e) {
            return json_error(404);
        } catch (\Exception $e) {
            Log::debug($e->getMessage(), $e->getTrace());
            return json_error();
        }
    }

    public function update(Request $request, ClientRepository $clientRepository, $id)
    {
        try {
            $data = $request->all();
            $client = $clientRepository->update($id, $data);
            return ClientResource::make($client);
        } catch (ModelNotFoundException $e) {
            return json_error(404);
        } catch (\Exception $e) {
            Log::debug($e->getMessage(), $e->getTrace());
            return json_error();
        }
    }

    public function destroy(ClientRepository $clientRepository, $id)
    {
        try {
            $clientRepository->delete($id);
            return response()->json([], 204);
        } catch (ModelNotFoundException $e) {
            return json_error(404);
        } catch (\Exception $e) {
            Log::debug($e->getMessage(), $e->getTrace());
            return json_error();
        }
    }
}
