<?php

namespace App\Services\V1;

use App\Models\User;
use App\Repositories\V1\UserRepository;

class FollowService
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

    public function followUser($data): User
    {
        $user = $data->user();
        $userToBeFollowed = $this->userRepository->getById($data->validated()['id']);
        if(!$user->isFollowing($userToBeFollowed)){
            $user->follow($userToBeFollowed);
        }
        return $userToBeFollowed;
    }
}
