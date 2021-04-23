<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Auth\RegisterRequest;
use App\Http\Resources\V1\Auth\RegisterResource;
use App\Http\Responses\Response;
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
     * @return Response
     */
    public function register(RegisterRequest $request): Response
    {
        $user = $this->registerService->register($request->validated());
        return new Response(new RegisterResource($user), 201);
    }
}
