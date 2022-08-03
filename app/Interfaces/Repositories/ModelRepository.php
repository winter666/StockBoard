<?php


namespace App\Interfaces\Repositories;


use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface ModelRepository
{
    public function all(): Collection;

    public function get(int $id): Model;
}
