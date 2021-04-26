<?php

namespace App\Repositories\V1;

use App\Models\User;

/**
 * Layer to handle datastore operations. Can be a local operation or external datastore
 */
class UserRepository
{
    /**
     * Variable to hold injected dependency
     *
     * @var [type]
     */
    protected $user;

    /**
     * Initializing the instances and variables
     *
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function getUsersWithCount($data){
        return $this->user->withCount($data)->get();
    }


    public function getById($id): User
    {
        return $this->user->find($id);
    }

    public function getByEmail($email): User
    {
        return $this->user->where('email', $email)->first();
    }

    public function findFollower($id, $follower_id)
    {
        return $this->getById($id)->followers()->find($follower_id);
    }

    public function findFollowing($id, $following_id)
    {
        return $this->getById($id)->following()->find($following_id);
    }

    public function follow($id, $following_id): void
    {
        $this->getById($id)->following()->attach($following_id);
    }

    public function update($data, $id): User
    {
        unset($data['image']);
        $user = $this->getById($id);
        $user->update($data);
        return $user;
    }

    public function save($data): User
    {
        return $this->user->create($data);
    }
}
