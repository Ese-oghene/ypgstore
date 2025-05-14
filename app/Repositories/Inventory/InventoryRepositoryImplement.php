<?php

namespace App\Repositories\Inventory;

use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\Inventory;

class InventoryRepositoryImplement extends Eloquent implements InventoryRepository{

    /**
    * Model class to be used in this repository for the common methods inside Eloquent
    * Don't remove or change $this->model variable name
    * @property Model|mixed $model;
    */
    protected Inventory $model;

    public function __construct(Inventory $model)
    {
        $this->model = $model;
    }

    // Write something awesome :)
}
