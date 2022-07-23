<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Interfaces\AdRepositoryInterface;
use App\Http\Requests\StoreAdRequest;
use App\Http\Requests\IndexAdRequest;
use App\Http\Requests\ShowAdRequest;
use App\Http\Resources\AdPaginatedCollection;
use App\Http\Resources\AdResource;

class AdController extends Controller
{
    private $repository;

    public function __construct(AdRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function index(IndexAdRequest $request) {
        $items = $this->repository->getAll($request->all());

        $formatted_items = new AdPaginatedCollection($items);

        return response()->json($formatted_items, 200);
    }

    public function show(ShowAdRequest $request, int $id) {
        $item = $this->repository->getById($id);

        $formatted_item = new AdResource($item);

        return response()->json($formatted_item, 200);
    }

    public function store(StoreAdRequest $request) {
        $item = $this->repository->make($request->all());

        return response()->json($item->id, 200);
    }
}
