<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Follow\StoreFollowRequest;
use App\Http\Resources\V1\UserResource;
use App\Http\Responses\Response;
use App\Services\V1\FollowService;

class FollowController extends Controller
{
    /**
     * @var $followService
     */
    protected $followService;

    /**
     * FollowController Constructor
     *
     * @param FollowService $followService
     */
    public function __construct(FollowService $followService)
    {
        $this->followService = $followService;
    }

    /**
     * Storing FollowRequest (Following Users)
     * @param StoreFollowRequest $request
     * @return \App\Http\Responses\Response
     */
    public function store(StoreFollowRequest $request): Response
    {
        $followedUser = $this->followService->followUser($request->validated(), $request->user()->id);
        return new Response(new UserResource($followedUser),201);
    }

}
