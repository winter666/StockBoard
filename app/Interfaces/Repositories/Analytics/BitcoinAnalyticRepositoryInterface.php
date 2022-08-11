<?php


namespace App\Interfaces\Repositories\Analytics;


use App\Interfaces\Repositories\ModelRepository;
use Illuminate\Database\Eloquent\Collection;

interface BitcoinAnalyticRepositoryInterface extends ModelRepository
{
    public function getOrderLatest(): Collection;
}
