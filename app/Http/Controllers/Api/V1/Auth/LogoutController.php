<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Responses\Response;
use App\Services\V1\Auth\LogoutService;
use Illuminate\Http\Request;

class LogoutController extends Controller
{
    /**
     * @var LogoutService $logoutService
     */
    protected $logoutService;

    /**
     * LoginController Constructor
     *
     * @param LogoutService $logoutService
     */
    public function __construct(LogoutService $logoutService)
    {
        $this->logoutService = $logoutService;
    }

    public function logout(Request $request): Response
    {
        $response = $this->logoutService->logout($request->user()->currentAccessToken()->id);
        return new Response([], $response["status"], $response["message"]);
    }
}
