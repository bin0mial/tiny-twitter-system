<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Auth\RegisterRequest;
use App\Http\Resources\V1\Auth\RegisterResource;
use App\Services\V1\Auth\RegisterService;

class RegisterController extends Controller
{
    /**
     * @var $registerService
     */
    protected $registerService;

    /**
     * LoginController Constructor
     *
     * @param RegisterService $registerService
     */
    public function __construct(RegisterService $registerService)
    {
        $this->registerService = $registerService;
    }
    /**
     * Registering new user
     * @param RegisterRequest $request
     */
    public function register(RegisterRequest $request){
        $user = $this->registerService->register($request);
        return (new RegisterResource($user))->response()->setStatusCode(201);
    }
}
