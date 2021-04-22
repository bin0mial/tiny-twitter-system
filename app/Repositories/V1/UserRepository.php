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

    public function getById($id): User
    {
        return $this->user->find($id);
    }

    public function getByEmail($email): User
    {
        return $this->user->where('email', $email)->first();
    }

    public function update($data, $id): User
    {
        $user = $this->getById($id);
        $user->attempts = $data["attempts"];
        $user->update();
        return $user;
    }

    public function save($data): User
    {
        return $this->user->create($data);
    }
}
