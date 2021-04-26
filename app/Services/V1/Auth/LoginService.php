<?php

namespace App\Services\V1\Auth;

use App\Repositories\V1\UserRepository;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Laravel\Sanctum\NewAccessToken;

class LoginService
{
    private $maxFailAttempts = 5;
    private $blockedForMinutes = 30;

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
     * Authenticating User
     * @param $data
     * @return NewAccessToken
     * @throws ValidationException
     */
    public function authenticate($data): NewAccessToken
    {
        $user = $this->userRepository->getByEmail($data["email"]);

        $this->throttle($user);

        $this->validateCredentials($user, $data["password"]);

        return $user->createToken($data["device_name"]);
    }


    /**
     * @throws ValidationException
     */
    private function throttle($user): void
    {
        if ($user->isBanned()) {
            $user->attempts = 0;
            $this->userRepository->update($user->toArray(), $user->id);

            throw ValidationException::withMessages([
                'email' => ["Your account have been locked for 30 minutes due to incorrect attempts"],
            ]);
        }
    }

    /**
     * @throws ValidationException
     */
    private function validateCredentials($user, $password): void
    {

        if (!Hash::check($password, $user->password)) {
            $user->banned_at = null;
            $user->ban_expire_at = null;

            if ($user->attempts++ >= $this->maxFailAttempts - 1) {
                $user->banned_at = now();
                $user->ban_expire_at = now()->addMinutes($this->blockedForMinutes);
            }
            $this->userRepository->update($user->toArray(), $user->id);

            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }
    }
}
