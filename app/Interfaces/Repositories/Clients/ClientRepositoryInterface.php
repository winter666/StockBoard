<?php


namespace App\Interfaces\Repositories\Clients;


use App\Interfaces\Repositories\ModelRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

interface ClientRepositoryInterface extends ModelRepository
{
    public function allOrderByIdDesc(): Collection;

    public function paginateOrderByIdDesc(int $limit = 15): LengthAwarePaginator;
}
