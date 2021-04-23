<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Auth\LoginRequest;
use App\Http\Resources\V1\Auth\LoginResource;
use App\Http\Responses\Response;
use App\Services\V1\Auth\LoginService;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    /**
     * @var $loginService
     */
    protected $loginService;

    /**
     * LoginController Constructor
     *
     * @param LoginService $loginService
     */
    public function __construct(LoginService $loginService)
    {
        $this->loginService = $loginService;
    }

    /**
     * Authenticating User
     * @param LoginRequest $request
     * @return \App\Http\Responses\Response
     * @throws ValidationException
     */
    public function login(LoginRequest $request): Response
    {
        $userAccessToken = $this->loginService->authenticate($request->validated());
        return new Response(new LoginResource($userAccessToken), 200);
    }
}
