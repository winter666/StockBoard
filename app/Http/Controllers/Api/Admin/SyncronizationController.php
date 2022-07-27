<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\API\SyncronizationRepository;
use Illuminate\Http\Request;

class SyncronizationController extends Controller
{
    public function index(Request $request, SyncronizationRepository $repository)
    {
        $limit = $request->get('limit');
        return response()->json(['data' => $repository->paginate($limit)]);
    }
}
