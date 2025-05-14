<?php

namespace App\Services\User;

use LaravelEasyRepository\BaseService;

interface UserService extends BaseService{

    // Write something awesome :)
   public function register($request);
    public function login($request);

     public function logout($request);
    public function adminLogin($request);


//    public function logout($request);
//    public function adminLogin($request);
}
