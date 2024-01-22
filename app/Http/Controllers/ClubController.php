<?php

namespace App\Http\Controllers;

use App\Models\Club;
use Illuminate\Http\Request;
use App\Services\ClubService;
use App\Http\Requests\Club\ClubStoreRequest;
use App\Http\Requests\Club\ClubUpdateRequest;

class ClubController extends Controller
{
    protected $clubService;

    public function __construct(ClubService $clubService)
    {
        $this->clubService = $clubService;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            return $this->clubService->getClubDataTable();
        }

        return view('club.index');
    }

    public function store(ClubStoreRequest $request)
    {
        $validatedData = $request->validated();

        try {
            $clubData = $this->clubService->storeClub($validatedData);

            return response()->json([
                'success' => 'Club Added Successfully',
                'resource' => $clubData,
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
        $club = $this->clubService->getClubById($id);

        return response()->json($club);
    }

    public function update(ClubUpdateRequest $request, $id)
    {
        $club = Club::findOrFail($id);
        $this->clubService->updateClub($club, $request->validated());

        return response()->json([
            'success' => 'Club Data Updated Successfully',
        ]);
    }

    public function destroy($id)
    {
        $club = Club::findOrFail($id);
        $this->clubService->deleteClub($club);

        return response()->json([
            'success' => 'Club Data Deleted Successfully',
        ]);
    }
}
