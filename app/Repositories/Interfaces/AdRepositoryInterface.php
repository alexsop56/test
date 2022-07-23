<?php

namespace App\Repositories\Interfaces;
use App\Models\Ad;
use Illuminate\Pagination\LengthAwarePaginator;

interface AdRepositoryInterface {
    public function getAll(array $params) :LengthAwarePaginator;
    public function getById(int $id) :Ad | null;
    public function make(array $params) :Ad;
}