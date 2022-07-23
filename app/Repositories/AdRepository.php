<?php

namespace App\Repositories;

use App\Repositories\Interfaces\AdRepositoryInterface;
use App\Models\Ad;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Schema;

class AdRepository implements AdRepositoryInterface {
    private $default_items_on_page = 10;

    public function getAll(array $params) :LengthAwarePaginator {
        $items = Ad::query();

        $is_not_exists_column = isset($params["sort_by"]) && !Schema::hasColumn('ads', $params["sort_by"]);
        if(!isset($params["sort_by"]) || $is_not_exists_column) {
            $params["sort_by"] = "price";
        }

        if(!isset($params["sort_dir"])) {
            $params["sort_dir"] = "desc";
        }

        $items->orderBy($params["sort_by"], $params["sort_dir"]);

        return $items->paginate($this->default_items_on_page);
    }

    public function getById(int $id) :Ad | null {
        return Ad::find($id);
    }

    public function make(array $params) :Ad {
        $ad = new Ad();
        $ad->fill($params);
        $ad->save();

        return $ad;
    }
}