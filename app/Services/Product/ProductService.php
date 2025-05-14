<?php

namespace App\Services\Product;

use LaravelEasyRepository\BaseService;

interface ProductService extends BaseService{

    public function getAll();
    public function getById($id);
    public function create($data);
    public function update($id, array $data);
    public function delete($id);
}
