<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Auth\LoginRequest;
use App\Http\Resources\V1\Auth\LoginResource;
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
     * @return \Illuminate\Http\JsonResponse|object
     * @throws ValidationException
     */
    public function login(LoginRequest $request)
    {
        $userAccessToken = $this->loginService->authenticate($request);
        return (new LoginResource($userAccessToken))->response()->setStatusCode(200);
    }
}
