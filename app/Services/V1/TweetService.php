<?php

namespace App\Services\V1;

use App\Repositories\V1\TweetRepository;

class TweetService
{

    /**
     * Variable to hold injected dependency
     *
     * @var $tweetRepository
     */
    protected $tweetRepository;

    /**
     * Initializing the instances and variables
     *
     * @param TweetRepository $tweetRepository
     */
    public function __construct(TweetRepository $tweetRepository)
    {
        $this->tweetRepository = $tweetRepository;
    }

    public function saveTweetData($data)
    {
        $tweetData = $data->validated();
        $tweetData["user_id"] = $data->user()->id;
        return $this->tweetRepository->save($tweetData);
    }
}
