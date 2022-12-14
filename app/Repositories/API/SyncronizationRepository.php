<?php


namespace App\Repositories\API;


use App\Interfaces\Repositories\API\SyncronizationRepositoryInterface;
use App\Models\API\Syncronization;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class SyncronizationRepository implements SyncronizationRepositoryInterface
{

    public function all(): Collection
    {
        return Syncronization::all();
    }

    public function paginate($limit = 15)
    {
        return Syncronization::query()->orderBy('id', 'desc')
            ->paginate($limit);
    }

    public function get(int $id): Model|null
    {
        return Syncronization::query()->find($id);
    }

    public function getByStatus(string $status)
    {
        return Syncronization::query()->where('status', $status)->get();
    }

    public function getCompleted()
    {
        return Syncronization::query()
            ->where('status', Syncronization::STATUS_COMPLETED)
            ->get();
    }

    public function getFailed()
    {
        return Syncronization::query()
            ->where('status', Syncronization::STATUS_FAILED)
            ->get();
    }

    public function getInProgress()
    {
        return Syncronization::query()
            ->where('status', Syncronization::STATUS_IN_PROGRESS)
            ->get();
    }

    public function create(array $data): Model
    {
        return Syncronization::query()->create($data);
    }
}
