<?php


namespace App\Repositories\Clients;


use App\Interfaces\Repositories\Clients\ClientRepositoryInterface;
use App\Models\Clients\Client;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class ClientRepository implements ClientRepositoryInterface
{

    public function all(): Collection
    {
        return Client::all();
    }

    public function get(int $id): Model
    {
        return Client::query()->find($id);
    }

    public function allOrderByIdDesc(): Collection
    {
        return Client::query()
            ->orderByDesc('id')
            ->get();
    }

    public function paginateOrderByIdDesc(int $limit = 15): LengthAwarePaginator
    {
        return Client::query()
            ->orderByDesc('id')
            ->paginate($limit);
    }
}
