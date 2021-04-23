<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Services\V1\StatisticsService;

class StatisticsController extends Controller
{
    /**
     * @var $statisticsService
     */
    protected $statisticsService;

    /**
     * StatisticsController Constructor
     *
     * @param StatisticsService $statisticsService
     */
    public function __construct(StatisticsService $statisticsService)
    {
        $this->statisticsService = $statisticsService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->statisticsService->getUsersStatisticsPDFData();
    }
}
