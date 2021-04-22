<?php

namespace App\Repositories\V1;

use App\Models\Tweet;

/**
 * Layer to handle datastore operations. Can be a local operation or external datastore
 */
class TweetRepository
{
    /**
     * Variable to hold injected dependency
     *
     * @var [type]
     */
    protected $tweet;

    /**
     * Initializing the instances and variables
     *
     * @param Tweet $tweet
     */
    public function __construct(Tweet $tweet)
    {
        $this->tweet = $tweet;
    }

    public function save($data){
        return $this->tweet->create($data);
    }
}
