<?php

namespace App\Dtos;

use App\Http\Requests\RegisterUserRequest;
use App\Interfaces\DtoInterface;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Http\FormRequest;

class UserDto implements DtoInterface
{
   //  private array $providedFields = [];

   //  // ... existing properties and methods ...

   //  public function setProvidedFields(array $fields): void
   //  {
   //      $this->providedFields = $fields;
   //  }

   //  public function getProvidedFields(): array
   //  {
   //      return $this->providedFields;
   //  }

   //  public function wasProvided(string $field): bool
   //  {
   //      return in_array($field, $this->providedFields);
   //  }
   //  private ?int $id;
   //  private ?string $email = "";
   //  private ?string $name = "";
   //  private string $lastname = "";
   //  private ?string $middlename = "";
   //  private ?string $phone_number = "";
   //  private ?string $address = null;
   //  private ?string $sog = "";
   //  private ?string $dob = null; // Changed to nullable
   //  private ?string $gender = null; // Changed to nullable
   //  private ?string $profile_image = null;
   //  private ?string $pin = null;
   //  private ?string $password = "";
   //  private ?Carbon $created_at;
   //  private ?Carbon $updated_at;
   
   
   //  Latest to fd
    private ?int $id;
    private string $email;
    private string $name;
    private string $lastname;
    private ?string $middlename; 
    private string $password;
    private string $phone_number;
    private string $address;
    private string $sog;
    private string $dob;
    private string $gender;
    private ?string $profile_image = null; // Nullable to handle when profile image is not provided.

    private ?string $pin;
   
   

    private ?Carbon $created_at;

    private ?Carbon $updated_at;

   //   Constructor to initialize the properties (optional)
     public function __construct()
     {
         $this->profile_image = null; // Default value for profile_image
         $this->middlename = null; // Initialize middlename as null by default
     }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }
    /**
     * @return string
     */
    public function getlastName(): string
    {
        return $this->lastname;
    }

    /**
     * @param string $lastname
     */
    public function setlastName(?string $lastname): void
    {
        $this->lastname = $lastname;
    }

    /**
     * @return string|null
     */
    public function getMiddlename(): ?string
    {
        // if ($this->middlename === null) {
        //     return ''; // Handle the case where the middlename is not set
        // }
        return $this->middlename;
    }

    /**
     * @param string|null $middlename
     */
    public function setMiddlename(?string $middlename): void
    {
        $this->middlename = $middlename ?? '';
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     */
    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email ;
    }

    /**
     * @return string
     */
    public function getPhoneNumber(): string
    {
        return $this->phone_number;
    }

    /**
     * @param string $phone_number
     */
    public function setPhoneNumber(string $phone_number): void
    {
        $this->phone_number = $phone_number ;
    }
   
    /**
     * @return string
     */
    public function getAddress(): string
    {
        return $this->address;
    }

    /**
     * @param string $address
     */
    public function setAddress(string $address): void
    {
        $this->address = $address;
    }
    /**
     * @return string
     */
    public function getSog(): string
    {
        return $this->sog;
    }

    /**
     * @param string $sog
     */
    public function setSog(string $sog): void
    {
        $this->sog = $sog;
    }
    /**
     * @return string
     */
    public function getDob(): string
    {
        return $this->dob;
    }

    /**
     * @param string $dob
     */
    // public function setDob(string $dob): void
    // {
    //     $this->dob = $dob;
    // }
    public function setDob(?string $dob): void
    {
        $this->dob = $dob;
    }

    /**
     * @return string
     */
    public function getGender(): string
    {
        return $this->gender;
    }

    /**
     * @param string $gender
     */
    // public function setGender(string $gender): void
    // {
    //     $this->gender = $gender;
    // }
    public function setGender(?string $gender): void
    {
        $this->gender = $gender;
    }

     /**
     * @return string|null
     */
    // public function getProfile_image(): ?string
    // {
    //     return $this->profile_image;
    // }

    // /**
    //  * @param string|null $imagePath
    //  */
    // public function setProfile_image(?string $imagePath): void
    // {
    //     $this->profile_image = $imagePath;
    // }

     /**
     * @return string
     */
    public function getProfile_image(): ?string
    {
        return $this->profile_image;
    }

    /**
     * @param string $profile_image
     */
    public function setProfile_image(?string $imagePath): void
    {
        $this->profile_image = $imagePath;
    }

    /**
     * @return string|null
     */
    public function getPin(): ?string
    {
        return $this->pin;
    }

    /**
     * @param string|null $pin
     */
    public function setPin(?string $pin): void
    {
        $this->pin = $pin;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
//     public function setPassword(string $password): void
// {
//     if ($password !== null) {
//         $this->password = $password;
//     }
// }
// public function setPassword(?string $password): void
// {
//     // Only set if password is not null
//     if ($password !== null) {
//         $this->password = $password;
//     }
// }
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    /**
     * @return Carbon|null
     */
    public function getCreatedAt(): ?Carbon
    {
        return $this->created_at;
    }

    /**
     * @param Carbon|null $created_at
     */
    public function setCreatedAt(?Carbon $created_at): void
    {
        $this->created_at = $created_at;
    }

    /**
     * @return Carbon|null
     */
    public function getUpdatedAt(): ?Carbon
    {
        return $this->updated_at;
    }

    /**
     * @param Carbon|null $updated_at
     */
    public function setUpdatedAt(?Carbon $updated_at): void
    {
        $this->updated_at = $updated_at;
    }

// public function __construct()
// {
//    //  $this->profile_image = null; // Default value for profile_image
//    //  $this->middlename = null; // Initialize middlename as null by default
// }

// /**
// * @return string
// */
// public function getName(): ?string
// {
//    return $this->name;
// }

// /**
// * @param string $name
// */
// public function setName(?string $name): void
// {
//    $this->name = $name ?? '';
// }
// /**
// * @return string
// */
// public function getlastName(): ?string
// {
//    return $this->lastname;
// }

// /**
// * @param string $lastname
// */
// public function setlastName(?string $lastname): void
// {
//    $this->lastname = $lastname  ?? '';
// }

// /**
// * @return string|null
// */
// public function getMiddlename(): ?string
// {
//    // if ($this->middlename === null) {
//    //     return ''; // Handle the case where the middlename is not set
//    // }
//    return $this->middlename;
// }

// /**
// * @param string|null $middlename
// */
// public function setMiddlename(?string $middlename): void
// {
//    $this->middlename = $middlename ?? '';
// }

// /**
// * @return int|null
// */
// public function getId(): ?int
// {
//    return $this->id;
// }

// /**
// * @param int|null $id
// */
// public function setId(?int $id): void
// {
//    $this->id = $id;
// }

// /**
// * @return string
// */
// public function getEmail(): ?string
// {
//    return $this->email;
// }

// /**
// * @param string $email
// */
// public function setEmail(?string $email): void
// {
//    $this->email = $email  ?? '' ;
// }

// /**
// * @return string
// */
// public function getPhoneNumber(): ?string
// {
//    return $this->phone_number;
// }

// /**
// * @param string $phone_number
// */
// public function setPhoneNumber(?string $phone_number): void
// {
//    $this->phone_number = $phone_number  ?? '' ;
// }

// /**
// * @return string
// */
// public function getAddress(): ?string
// {
//    return $this->address;
// }

// /**
// * @param string $address
// */
// public function setAddress(?string $address): void
// {
//    $this->address = $address;
// }
// /**
// * @return string
// */
// public function getSog(): ?string
// {
//    return $this->sog;
// }

// /**
// * @param string $sog
// */
// public function setSog(?string $sog): void
// {
//    $this->sog = $sog  ?? '';
// }
// /**
// * @return string
// */
// public function getDob(): ?string
// {
//    return $this->dob;
// }

// /**
// * @param string $dob
// */
// // public function setDob(string $dob): void
// // {
// //     $this->dob = $dob;
// // }
// public function setDob(?string $dob): void
// {
//    $this->dob = $dob;
// }

// /**
// * @return string
// */
// public function getGender(): ?string
// {
//    return $this->gender;
// }

// /**
// * @param string $gender
// */
// // public function setGender(string $gender): void
// // {
// //     $this->gender = $gender;
// // }
// public function setGender(?string $gender): void
// {
//    $this->gender = $gender;
// }

// /**
// * @return string|null
// */
// // public function getProfile_image(): ?string
// // {
// //     return $this->profile_image;
// // }

// // /**
// //  * @param string|null $imagePath
// //  */
// // public function setProfile_image(?string $imagePath): void
// // {
// //     $this->profile_image = $imagePath;
// // }

// /**
// * @return string
// */
// public function getProfile_image(): ?string
// {
//    return $this->profile_image;
// }

// /**
// * @param string $profile_image
// */
// public function setProfile_image(?string $imagePath): void
// {
//    $this->profile_image = $imagePath;
// }

// /**
// * @return string|null
// */
// public function getPin(): ?string
// {
//    return $this->pin;
// }

// /**
// * @param string|null $pin
// */
// public function setPin(?string $pin): void
// {
//    $this->pin = $pin;
// }

// /**
// * @return string
// */
// public function getPassword(): ?string
// {
//    return $this->password;
// }

// /**
// * @param string $password
// */
// //     public function setPassword(string $password): void
// // {
// //     if ($password !== null) {
// //         $this->password = $password;
// //     }
// // }
// public function setPassword(?string $password): void
// {
// // Only set if password is not null
// if ($password !== null) {
//    $this->password = $password;
// }
// }
// // public function setPassword(string $password): void
// // {
// //     $this->password = $password;
// // }

// /**
// * @return Carbon|null
// */
// public function getCreatedAt(): ?Carbon
// {
//    return $this->created_at;
// }

// /**
// * @param Carbon|null $created_at
// */
// public function setCreatedAt(?Carbon $created_at): void
// {
//    $this->created_at = $created_at;
// }

// /**
// * @return Carbon|null
// */
// public function getUpdatedAt(): ?Carbon
// {
//    return $this->updated_at;
// }

// /**
// * @param Carbon|null $updated_at
// */
// public function setUpdatedAt(?Carbon $updated_at): void
// {
//    $this->updated_at = $updated_at;
// }





    public static function fromAPiFormRequest(FormRequest $request): DtoInterface
    {
        $userDto = new UserDto();
        $userDto->setName($request->input('name'));
        $userDto->setlastName($request->input('lastname'));
        $userDto->setEmail($request->input('email'));
        $userDto->setPassword($request->input('password'));
        $userDto->setPhoneNumber($request->input('phone_number'));
        $userDto->setAddress($request->input('address'));
        $userDto->setSog($request->input('sog'));
        $userDto->setDob($request->input('dob'));
        $userDto->setGender($request->input('gender'));
        // Optionally set middlename if present in the request
        if ($request->has('middlename')) {
            // \Log::info('Middlename: ' . $request->input('middlename'));
            $userDto->setMiddlename($request->input('middlename'));
        }
        if ($request->hasFile('profile_image')) {
            // Store the image file in the 'profile_images' directory and return the path
            $imagePath = $request->file('profile_image')->store('profile_images', 'public');
            $userDto->setProfile_image($imagePath); // Store the file path in the DTO
        }
      //   if ($request->hasFile('profile_image') && $request->file('profile_image')->isValid()) {
      //       $imagePath = $request->file('profile_image')->store('profile_images', 'public');
      //       $userDto->setProfile_image($imagePath); // Store the file path in the DTO
      //   }
        
        // \Log::info('Profile Image: ' . $request->file('profile_image')->getClientOriginalName());
// }
        return $userDto;
    }
// public static function fromAPiFormRequest(FormRequest $request): DtoInterface
// {
//     $userDto = new UserDto();
    
//     // Safely set all fields with null checks
//     $userDto->setName($request->input('name', ''));
//     $userDto->setLastName($request->input('lastname', ''));
//     $userDto->setMiddlename($request->input('middlename'));
//     if ($request->filled('password')) {
//         $userDto->setPassword($request->input('password'));
//     }
//     $userDto->setEmail($request->input('email', ''));
//     $userDto->setPhoneNumber($request->input('phone_number', ''));
//     $userDto->setAddress($request->input('address', ''));
//     $userDto->setDob($request->input('dob'));
//     $userDto->setSog($request->input('sog', ''));
//     $userDto->setGender($request->input('gender'));

//     // if ($request->has('password')) {
//     //     $userDto->setPassword($request->input('password'));
//     // }
    
//     // Handle file upload
//     if ($request->hasFile('profile_image')) {
//         $imagePath = $request->file('profile_image')->store('profile_images', 'public');
//         $userDto->setProfile_image($imagePath);
//     }
    
//     return $userDto;
// }

// private array $providedFields = [];

// public function setProvidedFields(array $fields): void
// {
//     $this->providedFields = $fields;
// }

// public function wasProvided(string $field): bool
// {
//     return in_array($field, $this->providedFields);
// }
// public static function fromAPiFormRequest(FormRequest $request): DtoInterface
// {
//     $userDto = new UserDto();
//     $providedFields = [];

//     // Define all possible fields
//     $fields = [
//         'name', 'lastname', 'middlename', 'email',
//         'phone_number', 'address', 'dob', 'gender', 'sog'
//     ];

//     foreach ($fields as $field) {
//         if ($request->has($field)) {
//             $setter = 'set' . str_replace('_', '', ucwords($field, '_'));
//             $userDto->$setter($request->input($field));
//             $providedFields[] = $field;
//         }
//     }

//     // Handle password separately
//     if ($request->filled('password')) {
//         $userDto->setPassword($request->input('password'));
//         $providedFields[] = 'password';
//     }

//     // Handle file upload
//     if ($request->hasFile('profile_image')) {
//         $imagePath = $request->file('profile_image')->store('profile_images', 'public');
//         $userDto->setProfile_image($imagePath);
//         $providedFields[] = 'profile_image';
//     }

//     $userDto->setProvidedFields($providedFields);
//     return $userDto;
// }
    public static function fromModel(User|Model $model): UserDto
    {
        $userDto = new UserDto();
        $userDto->setId($model->id);
        $userDto->setName($model->name);
        $userDto->setEmail($model->email);
        $userDto->setPhoneNumber($model->phone_number);
        $userDto->setCreatedAt($model->created_at);
        $userDto->setUpdatedAt($model->updated_at);
        return $userDto;
    }

    public static function toArray(Model|User $model): array
    {
        return [
            'id' => $model->id,
            'name' => $model->name,
            'email' => $model->email,
            'phone_number' => $model->phone_number,
            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at,
        ];
    }
}
