<?php


namespace App\Interfaces\API;


interface SyncronizationRepositoryInterface
{
    public function all();

    public function get(int $id);

    public function getByStatus(string $status);

    public function getCompleted();

    public function getFailed();

    public function getInProgress();

    public function create(array $data);
}
