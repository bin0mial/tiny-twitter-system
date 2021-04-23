<?php

namespace App\Services\V1\Auth;

use App\Repositories\V1\TokenRepository;

class LogoutService
{
    /**
     * Variable to hold injected dependency
     *
     * @var TokenRepository
     */
    protected $tokenRepository;


    /**
     * Initializing the instances and variables
     *
     * @param TokenRepository $tokenRepository
     */
    public function __construct( TokenRepository $tokenRepository)
    {
        $this->tokenRepository = $tokenRepository;
    }

    /**
     * Clearing User Logins
     * @param $token_id
     */
    public function logout($token_id): array
    {
        $response = ["message"=> "Something went wrong", "status" => 500];
        if($this->tokenRepository->revokeToken($token_id)){
            $response["message"] = "User Logged out successfully";
            $response["status"] = 200;
        }
        return $response;
    }
}
