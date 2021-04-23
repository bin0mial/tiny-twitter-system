<?php

namespace App\Services\V1;

use App\Repositories\V1\TweetRepository;
use App\Repositories\V1\UserRepository;
use Illuminate\Support\Facades\App;

class StatisticsService
{

    /**
     * Variable to hold injected dependency
     *
     * @var $tweetRepository
     * @var $userRepository
     */
    protected $tweetRepository;
    protected $userRepository;

    /**
     * Initializing the instances and variables
     *
     * @param TweetRepository $tweetRepository
     * @param UserRepository $userRepository
     */
    public function __construct(TweetRepository $tweetRepository, UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
        $this->tweetRepository = $tweetRepository;
    }

    public function getUsersStatisticsPDFData()
    {
        $users = $this->userRepository->getUsersWithCount(["tweets"]);
        $tweetsCount = $this->tweetRepository->countTweets();
        $pdf = App::make('dompdf.wrapper');
        $pdf = $pdf->loadView('Statistics.index', ["users" => $users, "tweetsCount" => $tweetsCount]);
        return $pdf->stream('users_statistics.pdf');
    }
}
