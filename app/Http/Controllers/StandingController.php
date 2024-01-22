<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\StandingService;

class StandingController extends Controller
{
    protected $standingService;

    public function __construct(StandingService $standingService)
    {
        $this->standingService = $standingService;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            return $this->standingService->getStandingDataTable();
        }

        return view('standing.index');
    }
}
