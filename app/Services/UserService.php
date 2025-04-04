<?php

namespace App\Services;

use App\Dtos\UserDto;
use App\Exceptions\InvalidPinLengthException;
use App\Exceptions\PinHasAlreadyBeenSetException;
use App\Exceptions\PinNotSetException;
use App\Interfaces\UserServiceInterface;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class UserService implements UserServiceInterface
{
    public function createUser(UserDto $userDto): Builder|Model
    {
        return User::query()->create([
            'name' => $userDto->getName(),
            'lastname' => $userDto->getlastName(),
            'middlename' => $userDto->getMiddlename(),
            'email' => $userDto->getEmail(),
            'password' => $userDto->getPassword(),
            'phone_number' => $userDto->getPhoneNumber(),
            'address' => $userDto->getAddress(),
            'sog' => $userDto->getSog(),
            'dob' => $userDto->getDob(),
            'gender' => $userDto->getGender(),
            'profile_image' => $userDto->getProfile_image()
            
        ]);
    }

//     public function editUser(int $userId, UserDto $userDto): User
// {
//     $user = User::findOrFail($userId);
    
//     $updateData = [];
    
//     // List of all possible fields with their getters
//     $fields = [
//         'name' => 'getName',
//         'lastname' => 'getLastName',
//         'middlename' => 'getMiddlename',
//         'email' => 'getEmail',
//         'phone_number' => 'getPhoneNumber',
//         'address' => 'getAddress',
//         'dob' => 'getDob',
//         'gender' => 'getGender',
//         'sog' => 'getSog'
//     ];
    
//     foreach ($fields as $field => $getter) {
//         if ($userDto->wasProvided($field)) {
//             $updateData[$field] = $userDto->$getter();
//             $this->lastUpdatedFields[] = $field;
//         }
//     }

//     // ... handle password and profile image ...

//     if (!empty($updateData)) {
//         $user->update($updateData);
//     }

//     return $user->fresh();
// }

// public function getLastUpdatedFields(): array
// {
//     return $this->lastUpdatedFields;
// }

  
    // public function editUser(int $userId, UserDto $userDto): User
    // {
    //     $user = User::findOrFail($userId);
        
    //     $updateData = array_filter([
    //         'name' => $userDto->getName(),
    //         'lastname' => $userDto->getLastName(),
    //         'middlename' => $userDto->getMiddlename(),
    //         'email' => $userDto->getEmail(),
    //         'phone_number' => $userDto->getPhoneNumber(),
    //         // 'password' => $userDto->getPassword(),
    //         'address' => $userDto->getAddress(),
    //         'dob' => $userDto->getDob(),
    //         'sog' => $userDto->getSog(),
    //         'gender' => $userDto->getGender(),
    //     ], fn($value) => $value !== null);
    
    //     // Handle password update if provided
    //     if ($userDto->getPassword()) {
    //         $updateData['password'] = Hash::make($userDto->getPassword());
    //     }
    
    //     // Handle profile image if provided
    //     // if ($userDto->getProfile_image()) {
    //     //     // Delete old image if exists
    //     //     if ($user->profile_image && Storage::exists($user->profile_image)) {
    //     //         Storage::delete($user->profile_image);
    //     //     }
    //     //     $updateData['profile_image'] = $userDto->getProfile_image();
    //     // }
    
    //     $user->update($updateData);
        
    //     return $user->fresh();
    // }
    public function editUser(int $userId, UserDto $userDto): Builder|Model
{
    // Retrieve the user by their unique ID
    $user = User::findOrFail($userId);
    
    // Update the user's attributes with the new data from the UserDto
    // try {
    $user->update([
        'name' => $userDto->getName(),
        'lastname' => $userDto->getLastname(),
        'middlename' => $userDto->getMiddlename() ?: null, // Handle nullable middlename
        'email' => $userDto->getEmail(),
        'password' => $userDto->getPassword(),
        'phone_number' => $userDto->getPhoneNumber(),
        'address' => $userDto->getAddress(),
        'dob' => $userDto->getDob(),
        'sog' => $userDto->getSog(),
        'gender' => $userDto->getGender(),
        // 'profile_image' => $userDto->getProfile_image() ?: $user->profile_image, // Retain the old profile image if not updated
    ]);
     return $user;
} 


    /**
     * @param User $user
     * @param string $pin
     * @return void
     * @throws InvalidPinLengthException
     * @throws PinHasAlreadyBeenSetException
     */
    public function setupPin(User $user, string $pin): void
    {
        if ($this->hasSetPin($user)) {
            throw new PinHasAlreadyBeenSetException("Pin has already been set");
        }
        if (strlen($pin) != 4) {
            throw new InvalidPinLengthException();
        }
        $user->pin = Hash::make($pin);
        $user->save();
    }

    /**
     * @param string $pin
     * @return bool
     * @throws PinNotSetException
     */
    public function validatePin(int $userId, string $pin): bool
    {

        $user = $this->getUserById($userId);
        if (!$this->hasSetPin($user)) {
            throw new PinNotSetException("Please set your pin");
        }
        return Hash::check($pin, $user->pin);
    }

    /**
     * @param User $user
     * @return bool
     */
    public function hasSetPin(User $user): bool
    {
        return $user->pin != null;
    }



    /**
     * @param int $userId
     * @return Builder|Model
     */
    public function getUserById(int $userId): Builder|Model
    {
        $user = User::query()->where('id', $userId)->first();
        if (!$user) {
            throw new ModelNotFoundException("User not found");
        }
        return $user;
    }
}
