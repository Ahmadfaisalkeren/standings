<?php

namespace App\Services;

use App\Models\Club;
use App\Models\Score;
use App\Models\Standing;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

/**
 * Class ScoreService.
 */
class ScoreService
{
    public function getScoreDataTable()
    {
        $data = Score::orderBy('id', 'DESC')->get();

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('result', function ($data) {
                return $data->result;
            })
            ->addColumn('action', function ($data) {
                $delete = '<a href="javascript:void(0)" data-toggle="tooltip" data-id="' . $data->id . '" data-original-title="Delete" class="delete btn text-white btn-danger btn-sm mt-1 deleteScore"><i class="fas fa-trash"></i> Delete</a>';

                return $delete;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function getClubData()
    {
        $club = Club::all();

        return $club;
    }

    public function getScores()
    {
        $scores = Score::all();

        return $scores;
    }

    public function storeScore(array $data)
    {
        $score = Score::create($data);

        $scoreId = $score->id;

        $this->createStandingRecord($scoreId, $data['home_club_id'], $data['home_score'], $data['away_score']);
        $this->createStandingRecord($scoreId, $data['away_club_id'], $data['away_score'], $data['home_score']);
    }

    private function createStandingRecord($scoreId, $clubId, $goalsScored, $goalsConceded)
    {
        $standing = Standing::where('club_id', $clubId)->first();

        if (!$standing) {
            Standing::create([
                'score_id' => $scoreId,
                'club_id' => $clubId,
                'game_played' => 1,
                'win' => $goalsScored > $goalsConceded ? 1 : 0,
                'draw' => $goalsScored == $goalsConceded ? 1 : 0,
                'lose' => $goalsScored < $goalsConceded ? 1 : 0,
                'goal_scored' => $goalsScored,
                'goal_conceded' => $goalsConceded,
                'points' => $goalsScored > $goalsConceded ? 3 : ($goalsScored == $goalsConceded ? 1 : 0),
            ]);
        } else {
            $standing->game_played += 1;
            $standing->win += $goalsScored > $goalsConceded ? 1 : 0;
            $standing->draw += $goalsScored == $goalsConceded ? 1 : 0;
            $standing->lose += $goalsScored < $goalsConceded ? 1 : 0;
            $standing->goal_scored += $goalsScored;
            $standing->goal_conceded += $goalsConceded;
            $standing->points += $goalsScored > $goalsConceded ? 3 : ($goalsScored == $goalsConceded ? 1 : 0);

            $standing->save();
        }
    }

    public function getScoreById($id)
    {
        $score = Score::findOrFail($id);

        return $score;
    }

    public function deleteScore(Score $score)
    {
        DB::beginTransaction();

        try {
            $score->delete();

            $standings = Standing::where('score_id', $score->id)->get();
            foreach ($standings as $standing) {
                $standing->delete();
            }

            DB::commit();

            return response()->json([
                'success' => 'Data Score Berhasil Dihapus',
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(
                [
                    'error' => 'Error deleting score: ' . $e->getMessage(),
                ],
                422,
            );
        }
    }
}
