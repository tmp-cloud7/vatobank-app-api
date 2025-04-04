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
    //     try {
    //         $user = $request->user();
    //         $userDto = UserDto::fromAPiFormRequest($request);
            
    //         $updatedUser = $this->userService->editUser($user->id, $userDto);
            
    //         // Get the fields that were actually updated from the service
    //         $updatedFields = $this->userService->getLastUpdatedFields();
            
    //         return $this->sendSuccess([
    //             'user' => $updatedUser,
    //             'updated_fields' => $updatedFields
    //         ], 'Profile updated successfully');
            
    //     } catch (\Exception $e) {
    //         Log::error('User update failed: '.$e->getMessage());
    //         return $this->sendError('Could not update profile. Please try again.');
    //     }
    // }
//     Log::debug('Request data:', $request->all());
//     Log::debug('Request files:', $request->file() ?: ['no files']);


//     // Basic validation rules
//     $validationRules = [
//         'name' => 'sometimes|string|max:255',
//         'lastname' => 'sometimes|string|max:255',
//         'middlename' => 'sometimes|string|max:255',
//         'email' => 'sometimes|email|max:255|unique:users,email,'.$user->id,
//         'phone_number' => 'sometimes|string|max:20',
//         'address' => 'sometimes|string|max:255',
//         'dob' => 'sometimes|date',
//         'gender' => 'sometimes|in:male,female,other',
//         'profile_image' => 'sometimes|image|mimes:jpeg,png,jpg|max:2048'
//     ];

//     // Validate the request data
//     $validatedData = $request->validate($validationRules);

//     // Prepare update data - keep all non-null values
//     $updateData = array_filter($validatedData, fn($value) => $value !== null);

//     // Handle file upload if present
//     if ($request->hasFile('profile_image')) {
//         // Delete old image if exists
//         if ($user->profile_image && Storage ::disk('public')->exists($user->profile_image)) {
//             Storage::disk('public')->delete($user->profile_image);
//         }
        
//         // Store new image
//         $updateData['profile_image'] = $request->file('profile_image')
//             ->store('profile_images', 'public');
//     }

//     // Check if we have anything to update
//     if (empty($updateData)) {
//         return response()->json([
//             'success' => false,
//             'message' => 'No valid fields to update',
//             'hint' => 'Provide at least one of: ' . implode(', ', array_keys($validationRules))
//         ], 400);
//     }

//     // Perform the update
//     $user->update($updateData);

//     // Return success response with updated user data
//     return response()->json([
//         'success' => true,
//         'message' => 'Profile updated successfully',
//         'user' => $user->fresh(),
//         'updated_fields' => array_keys($updateData)
//     ]);
// }

//     public function editUser(Request $request): JsonResponse
// {
//     $user = $request->user();

//     if (empty($request->all())) {
//         return response()->json([
//             'success' => false,
//             'message' => 'Empty request received',
//             'documentation' => [
//                 'required_format' => 'JSON or form-data',
//                 'example_request' => [
//                     'JSON' => ['name' => 'New Name', 'email' => 'new@example.com'],
//                     'form-data' => 'name=New+Name&email=new@example.com'
//                 ],
//                 'available_fields' => [
//                     'name', 'email', 'phone_number', 
//                     'address', 'profile_image', 'dob'
//                 ]
//             ]
//         ], 400);
//     }
   
//     // Get the authenticated user
   

//     // Validate incoming request data
//     $validatedData = $request->validate([
//         'name' => 'nullable|string|max:255',
//         'lastname' => 'nullable|string|max:255',
//         'middlename' => 'nullable|string|max:255',
//         'email' => 'nullable|string|email|max:255|unique:users,email,' . $user->id,
//         'password' => 'nullable|string|min:8',
//         'phone_number' => 'nullable|string|max:20',
//         'address' => 'nullable|string|max:255',
//         'sog' => 'nullable|string|max:20',
//         'dob' => 'nullable|date',
//         'gender' => 'nullable|in:male,female,other',
//         'profile_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
//     ]);
//      // Filter out null/empty values but keep false/0
//      $updateData = array_filter($validatedData, fn($v) => $v !== null);
    
//     if (empty($updateData)) {
//         $received = array_filter($request->all(), fn($v) => $v !== null);
        
//         return response()->json([
//             'success' => false,
//             'message' => 'No updatable fields provided',
//             'received_data' => $received,
//             'rejected_fields' => array_diff(array_keys($received), array_keys($validatedData)),
//             'next_steps' => [
//                 'Check field names are correct',
//                 'Verify field values match validation rules',
//                 'Ensure Content-Type header is set properly'
//             ]
//         ], 400);
//     }
//     if (array_key_exists('password', $updateData)) {
//         $updateData['password'] = Hash::make($updateData['password']);
//     }


//     if ($request->hasFile('profile_image')) {
//         // Delete the old image if it exists (optional)
//         if ($user->profile_image && file_exists(storage_path('app/public/' . $user->profile_image))) {
//             unlink(storage_path('app/public/' . $user->profile_image));
//         }

//         // Store the new image in the 'profile_images' directory
//         $updateData['profile_image'] = $request->file('profile_image')
//         ->store('profile_images', 'public');
// }
// $user->update($updateData);

// return response()->json([
//     'success' => true,
//     'message' => 'Profile updated successfully',
//     'updated_fields' => array_keys($updateData),
//     'user' => $user->fresh()
// ]);
// }




    // } else {
    //     // Keep the old profile image if it's not being updated
    //     $validatedData['profile_image'] = $user->profile_image;
    // }

    // $user->update($validatedData);

    // $user->refresh();

    // // Return a success response with updated user data
    // return $this->sendSuccess(['user' => $user], 'User updated successfully');
//     Log::debug('Updating user with data:', $validatedData);

//     // Perform update
//     $updated = $user->update($validatedData);
    
//     if (!$updated) {
//         Log::error('User update failed for user ID: ' . $user->id);
//         return $this->sendError('Failed to update user profile');
//     }

//     // Explicitly reload the user model
//     $user = $user->fresh();

//     // Debugging: Log the returned user data
//     Log::debug('Updated user data:', $user->toArray());

//     return $this->sendSuccess([
//         'user' => $user->toArray() // Explicit conversion to array
//     ], 'User updated successfully');

// }
// public function editUser(Request $Request): JsonResponse
// {
//     $user = $Request->user();

//     $validatedData = $Request->validate([
//         'name' => 'required|string|max:255',         // Changed to required
//         'lastname' => 'required|string|max:255',     // Changed to required
//         'middlename' => 'nullable|string|max:255',
//         'address' => 'nullable|string|max:255',
//         'sog' => 'nullable|string|max:20',
//         'dob' => 'nullable|date',
//         'gender' => 'nullable|in:male,female,other',
//         'profile_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
//     ]);

//     if ($Request->hasFile('profile_image')) {
//         // Delete old image if exists
//         if ($user->profile_image) {  // Changed from 'image' to 'profile_image'
//             Storage::disk('public')->delete($user->profile_image);
//         }

//         $imagePath = $Request->file('profile_image')
//                            ->store('profile_images', 'public');
                           
//         $validatedData['profile_image'] = $imagePath; // Consistent field name
//     }

//     $user->update($validatedData);

//     return $this->sendSuccess([
//         'result' => [  // Match frontend expectation
//             'user' => $user->fresh() 
//         ]
//     ], 'User updated successfully');
// }

// }

// public function refresh(Request $request): JsonResponse
// {
//     $newtoken = $request->user()->createToken('auth-token')->plainTextToken;
//     return $this->sendSuccess(['token' => $newtoken], 'Token refreshed successfully');
// }
}
