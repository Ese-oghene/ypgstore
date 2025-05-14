<?php

namespace App\Repositories\Product;

use LaravelEasyRepository\Repository;

interface ProductRepository extends Repository{

    public function all();
    public function find($id);
    public function create($data);
    public function update($id, array $data);
    public function delete($id);
}
