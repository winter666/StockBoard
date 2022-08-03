<?php


namespace App\Interfaces\Repositories\Clients;


use App\Interfaces\Repositories\ModelRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface ClientRepositoryInterface extends ModelRepository
{
    public function allOrderByIdDesc(): Collection;

    public function paginateOrderByIdDesc(int $limit = 15): LengthAwarePaginator;

    public function getOrFail(int $id): Model;

    public function update(int $id, array $data): Model;

    public function delete(int $id);
}
