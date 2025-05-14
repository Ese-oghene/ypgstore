<?php

namespace App\Services\Inventory;

use LaravelEasyRepository\ServiceApi;
use App\Repositories\Inventory\InventoryRepository;

class InventoryServiceImplement extends ServiceApi implements InventoryService{

    /**
     * set title message api for CRUD
     * @param string $title
     */
     protected string $title = "";
     /**
     * uncomment this to override the default message
     * protected string $create_message = "";
     * protected string $update_message = "";
     * protected string $delete_message = "";
     */

     /**
     * don't change $this->mainRepository variable name
     * because used in extends service class
     */
     protected InventoryRepository $mainRepository;

    public function __construct(InventoryRepository $mainRepository)
    {
      $this->mainRepository = $mainRepository;
    }

    // Define your custom methods :)
}
