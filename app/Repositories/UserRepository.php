<?php
declare(strict_types=1);
namespace App\Repositories;

use App\Models\User;

class UserRepository
{
    private User $user;

    /**
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function createUser(string $username, string $email, string $password): User
    {
        return $this->user->newQuery()->create([
            'username' => $username,
            'email'    => $email,
            'password' => $password
        ]);
    }

}
