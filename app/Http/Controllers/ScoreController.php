<?php

namespace App\Http\Controllers;

use App\Models\Score;
use Illuminate\Http\Request;
use App\Services\ScoreService;
use App\Http\Requests\Score\ScoreStoreRequest;
use App\Http\Requests\Score\ScoreUpdateRequest;

class ScoreController extends Controller
{
    protected $scoreService;

    public function __construct(ScoreService $scoreService)
    {
        $this->scoreService = $scoreService;
    }

    public function index(Request $request)
    {
        $clubId = $request->input('club_id');

        if ($request->ajax()) {
            return $this->scoreService->getScoreDataTable();
        }

        $clubData = $this->scoreService->getClubData();

        return view('score.index', compact('clubData'));
    }

    public function store(ScoreStoreRequest $request)
    {
        $validatedData = $request->validated();

        try {
            $scoreData = $this->scoreService->storeScore($validatedData);

            return response()->json([
                'success' => 'Score Added Successfully',
                'resource' => $scoreData,
            ]);
        } catch (\Exception $e) {
            return response()->json(
                [
                    'error' => $e->getMessage(),
                ],
                422,
            );
        }
    }

    public function edit($id)
    {
        $score = $this->scoreService->getScoreById($id);

        return response()->json($score);
    }

    // public function update(ScoreUpdateRequest $request, $id)
    // {
    //     $score = Score::findOrFail($id);
    //     $this->scoreService->updateScore($score, $request->validated());

    //     return response()->json([
    //         'success' => 'Data Score Berhasil Diperbaharui',
    //     ]);
    // }

    public function destroy($id)
    {
        $score = Score::findOrFail($id);
        $this->scoreService->deleteScore($score);

        return response()->json([
            'success' => 'Data Score Berhasil Dihapus',
        ]);
    }
}
