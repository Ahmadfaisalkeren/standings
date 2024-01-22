<?php

namespace App\Services;

use App\Models\Club;
use App\Models\Standing;
use Yajra\DataTables\Facades\DataTables;

/**
 * Class StandingService.
 */
class StandingService
{
    public function getStandingDataTable()
    {
        $clubs = Club::all();

        $standings = Standing::with('club')
            ->orderBy('points', 'DESC')
            ->get();

        $mergedData = $clubs
            ->map(function ($club) use ($standings) {
                $standing = $standings->where('club_id', $club->id)->first();

                return [
                    'club_name' => $club->club_name,
                    'game_played' => optional($standing)->game_played ?? 0,
                    'win' => optional($standing)->win ?? 0,
                    'draw' => optional($standing)->draw ?? 0,
                    'lose' => optional($standing)->lose ?? 0,
                    'points' => optional($standing)->points ?? 0,
                    'goal_scored' => optional($standing)->goal_scored ?? 0,
                    'goal_conceded' => optional($standing)->goal_conceded ?? 0,
                ];
            })
            ->sortByDesc('points');

        return DataTables::of($mergedData)
            ->addIndexColumn()
            ->rawColumns(['action'])
            ->make(true);
    }
}
