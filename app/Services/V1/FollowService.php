<?php

namespace App\Services\V1;

use App\Models\User;
use App\Repositories\V1\UserRepository;

class FollowService
{

    /**
     * Variable to hold injected dependency
     *
     * @var UserRepository
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
     * @param $id
     * @return User
     */
    public function followUser($data, $id): User
    {
        $userToBeFollowed = $this->userRepository->getById($data['id']);
        if ($userToBeFollowed && !$this->userRepository->findFollowing($id, $userToBeFollowed->id)) {
            $this->userRepository->follow($id, $userToBeFollowed->id);
        }
        return $userToBeFollowed;
    }
}
