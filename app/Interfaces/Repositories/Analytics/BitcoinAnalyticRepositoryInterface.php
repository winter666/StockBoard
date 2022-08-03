<?php


namespace App\Interfaces\Repositories\Analytics;


use App\Interfaces\Repositories\ModelRepository;
use Illuminate\Database\Eloquent\Model;

interface BitcoinAnalyticRepositoryInterface extends ModelRepository
{
    public function create(array $data): Model;

    public function storeOnceADay(array $needle, array $data);
}
