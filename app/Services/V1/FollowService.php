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

    /**
     * Following User Logic Service
     * @param $data
     * @return User
     */
    public function followUser($data, $id): User
    {
        $user = $this->userRepository->getById($id);
        $userToBeFollowed = $this->userRepository->getById($data['id']);
        if(!$user->isFollowing($userToBeFollowed)){
            $user->follow($userToBeFollowed);
        }
        return $userToBeFollowed;
    }
}
