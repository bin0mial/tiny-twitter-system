<?php

namespace App\Services\V1\Auth;

use App\Repositories\V1\UserRepository;
use Cog\Contracts\Ban\BanService;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Laravel\Sanctum\NewAccessToken;

class LoginService
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
     * Authenticating User
     * @param $data
     * @return NewAccessToken
     * @throws ValidationException
     */
    public function authenticate($data): NewAccessToken
    {
        // It also scheduled, In case running schedule you can delete this line
        $this->deleteExpiredBans();

        $user = $this->userRepository->getByEmail($data["email"]);

        if ($user->isBanned()) {
            $user->attempts = 0;
            $this->userRepository->update($user->toArray(), $user->id);

            throw ValidationException::withMessages([
                'email' => ["Your account have been locked for 30 minutes due to incorrect attempts"],
            ]);
        }

        if (!Hash::check($data["password"], $user->password)) {
            if ($user->attempts++ >= 4) {
                $user->ban(["expired_at" => "+30 minute"]);
            }
            $this->userRepository->update($user->toArray(), $user->id);

            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }
        return $user->createToken($data["device_name"]);
    }

    /**
     * Deleting Expired Blocked accounts
     */
    private function deleteExpiredBans()
    {
        app(BanService::class)->deleteExpiredBans();
    }
}
