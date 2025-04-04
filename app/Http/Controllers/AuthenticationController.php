<?php

namespace App\Http\Controllers;

use App\Dtos\UserDto;
use App\Http\Requests\EditUserRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterUserRequest;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AuthenticationController extends Controller
{
    public function __construct(public readonly UserService $userService)
    {
    }

    public function register(RegisterUserRequest $request): JsonResponse
    {

        $userDto = UserDto::fromAPiFormRequest($request);
        $user = $this->userService->createUser($userDto);
        return $this->sendSuccess(['user' => $user], "Registration Successful");
    }

    public function login(LoginRequest $request): JsonResponse
    {
        $credentials = $request->validated();
        if (!Auth::attempt($credentials)) {
            return $this->sendError("The provided credentials are incorrect.");
        }
        $user = $request->user();
        $token = $user->createToken('auth-token')->plainTextToken;
        return $this->sendSuccess([
            'user' => $user,
            'token' => $token
        ], 'Log in successfully');
    }

    public function user(Request $request): JsonResponse
    {
        return $this->sendSuccess([
            'user' => $request->user(),
        ], 'Authenticated user retrieved');
    }


    public function logout(Request $request): JsonResponse
    {
        $user = $request->user();
        $user->tokens()->delete();
        return $this->sendSuccess([], 'Logged out successfully');
    }

    public function refresh(Request $request): JsonResponse
    {
        $user = $request->user();
        
        // If no user is authenticated, return an error.
        if (!$user) {
            return $this->sendError("User is not authenticated.");
        }

        // Revoke all existing tokens if needed, this is optional and can be adjusted based on your needs.
        // $user->tokens->each(function ($token) {
        //     $token->delete();
        // });

        // Generate a new token for the authenticated user
        $newToken = $user->createToken('auth-token')->plainTextToken;

        return $this->sendSuccess([
            'user' => $user,
            'token' => $newToken
        ], 'Token refreshed successfully');
    }

    public function editUser(EditUserRequest $request): JsonResponse
    {
        try {
            $user = $request->user();
            
            // Create DTO from request
            $userDto = UserDto::fromAPiFormRequest($request);
            
            // Update user via service
            $updatedUser = $this->userService->editUser($user->id, $userDto);
            
            return $this->sendSuccess(
                ['user' => $updatedUser], 
                'User updated successfully'
            );
            
        } catch (\Exception $e) {
            // Log::error("User update failed: " . $e->getMessage());
            return $this->sendError("Failed to update user profile");
     }
    }
}
