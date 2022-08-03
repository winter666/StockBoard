<?php


namespace App\Interfaces\Repositories\API;


use App\Interfaces\Repositories\ModelRepository;

interface SyncronizationRepositoryInterface extends ModelRepository
{
    public function getByStatus(string $status);

    public function getCompleted();

    public function getFailed();

    public function getInProgress();

    public function create(array $data);
}
