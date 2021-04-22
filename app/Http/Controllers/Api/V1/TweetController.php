<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Tweet\StoreTweetRequest;
use App\Http\Resources\V1\TweetResource;
use App\Services\V1\TweetService;

class TweetController extends Controller
{
    /**
     * @var $tweetService
     */
    protected $tweetService;

    /**
     * TweetController Constructor
     *
     * @param TweetService $tweetService
     */
    public function __construct(TweetService $tweetService)
    {
        $this->tweetService = $tweetService;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreTweetRequest $request
     * @return \Illuminate\Http\JsonResponse|object
     */
    public function store(StoreTweetRequest $request)
    {
        $tweet = $this->tweetService->saveTweetData($request);
        return (new TweetResource($tweet))->response()->setStatusCode(201);
    }

}
