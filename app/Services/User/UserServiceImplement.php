<?php

namespace App\Services\User;

use LaravelEasyRepository\ServiceApi;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\JsonResponse;

use App\Repositories\Auth\AuthRepository;
use App\Repositories\User\UserRepository;

class UserServiceImplement extends ServiceApi implements UserService{


    /**
     * AuthServiceImplement provides authentication and user management services.
     *
     * This service handles user authentication, registration, login, logout,
     * and password reset functionalities using Laravel's authentication mechanisms.
     * It implements the AuthService interface and extends the ServiceApi base class.
     */

     /**
     * don't change $this->mainRepository variable name
     * because used in extends service class
     */

     protected UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
      $this->userRepository = $userRepository;
    }

       /**
	 * Register a new user and generate an authentication token.
	 *
	 * @param mixed $request The validated registration request containing user details
	 * @return \Illuminate\Http\JsonResponse Registration response with user details and token
	 */

     public function register($request): JsonResponse
{
    try {
        $validated = $request->validated();
        $user = $this->userRepository->createUser($validated);
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Registration successful',
            'user' => new UserResource($user),
            'token' => $token
        ], 200);
    } catch (\Exception $e) {
        return response()->json([
            'message' => 'Registration failed',
            'error' => $e->getMessage()
        ], 400);
    }
}




     // Login function
    public function login($request):JsonResponse
	{
        $validated = $request->validated();
        $user = $this->userRepository->findUserByEmail($validated['email']);

        if (!$user || !Hash::check($validated['password'], $user->password)) {
            return response()->json([
                'message' => 'Invalid credentials'
            ], 401);
        }


		$user->tokens()->delete();

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Login successful',
            'user' => new UserResource($user),
            'token' => $token
        ], 200);
	}

    public function logout($request): JsonResponse
    {
        try {
            $user = $request->user();
            $user->tokens()->delete(); 

            return response()->json([
                'message' => 'Logout successful'
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Logout failed',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function adminLogin($request): JsonResponse
    {
        $validated = $request->validated();
        $user = $this->userRepository->findUserByEmail($validated['email']);

        if (!$user || !Hash::check($validated['password'], $user->password)) {
            return response()->json([
                'message' => 'Invalid credentials'
            ], 401);
        }

        if (!$user->hasRole('admin')) {
            return response()->json([
                'message' => 'Access denied. Not an admin user.'
            ], 403);
        }

        $user->tokens()->delete(); // Revoke old tokens
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Admin login successful',
            'user' => new UserResource($user),
            'token' => $token
        ], 200);
    }

}
