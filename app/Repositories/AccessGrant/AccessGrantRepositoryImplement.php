<?php

namespace App\Repositories\AccessGrant;

use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\AccessGrant;

class AccessGrantRepositoryImplement extends Eloquent implements AccessGrantRepository{

    /**
    * Model class to be used in this repository for the common methods inside Eloquent
    * Don't remove or change $this->model variable name
    * @property Model|mixed $model;
    */
    protected AccessGrant $model;

    public function __construct(AccessGrant $model)
    {
        $this->model = $model;
    }

    // Write something awesome :)
}
