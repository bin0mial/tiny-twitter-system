<?php

namespace App\Services\V1\Auth;

use App\Models\User;
use App\Repositories\V1\UserRepository;

class RegisterService
{

    /**
     * Variable to hold injected dependency
     *
     * @var $userRepository
     */
    protected $userRepository;

    /**
     * Initializing the instances and variables
     *
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function register($data): User
    {
        return $this->userRepository->save($data);
    }
}
