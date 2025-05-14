<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterUserRequest;
use App\Http\Resources\UserResource;
use App\Services\Interfaces\UserServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

use App\Http\Requests\LoginRequest;
use App\Services\User\UserService;


class AuthController extends Controller
{

     protected UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Handle user registration
     *
     * @param RegisterUserRequest $request
     * @return JsonResponse
     */

     public function register(RegisterUserRequest $request): JsonResponse
        {
            return $this->userService->register($request);
        }


    public function login(LoginRequest $request): JsonResponse
    {
        return $this->userService->login($request);
    }

    public function logout(Request $request): JsonResponse
    {
        return $this->userService->logout($request);
    }

    public function adminLogin(LoginRequest $request): JsonResponse
    {
        return $this->userService->adminLogin($request);
    }




}
