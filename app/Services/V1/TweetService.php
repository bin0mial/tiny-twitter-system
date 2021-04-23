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

    /**
     * Saving Tweets Data
     * @param $data
     * @return mixed
     */
    public function saveTweetData($data, $id)
    {
        $tweetData = $data;
        $tweetData["user_id"] = $id;
        return $this->tweetRepository->save($tweetData);
    }
}
