<?php

namespace App\Services\Payment;

use LaravelEasyRepository\ServiceApi;
use App\Repositories\Payment\PaymentRepository;

class PaymentServiceImplement extends ServiceApi implements PaymentService{

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
     protected PaymentRepository $mainRepository;

    public function __construct(PaymentRepository $mainRepository)
    {
      $this->mainRepository = $mainRepository;
    }

    // Define your custom methods :)
}
