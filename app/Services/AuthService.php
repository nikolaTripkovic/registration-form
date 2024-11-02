<?php

namespace App\Services;

use App\Repositories\UserRepository;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AuthService
{

    private UserRepository $userRepository;
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @throws \Exception
     */
    public function registerUser($username, $email, $password): ?Authenticatable
    {
        try {
            return $this->userRepository->createUser($username, $email, $this->hashPassword($password));
        } catch (\Exception $e) {
            Log::error("Register user exception: ".$e->getMessage());
            return null;
        }
    }

    public function loginUser(string $username, string $password): ?Authenticatable
    {
        if(Auth::attempt(['username' => $username, 'password' => $password])) {
            return Auth::getUser();
        }
        return null;
    }

    public function logoutUser(): void
    {
        Auth::logout();
    }

    private function hashPassword(string $password): string
    {
        return Hash::make($password);
    }

}
