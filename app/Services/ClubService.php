<?php

namespace App\Services;

use App\Models\Club;
use Yajra\DataTables\Facades\DataTables;

/**
 * Class ClubService.
 */
class ClubService
{
    public function getClubDataTable()
    {
        $data = Club::orderBy('id', 'ASC')->get();

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($data) {
                $edit = '<a href="javascript:void(0)" data-toggle="tooltip" data-id="' . $data->id . '" data-original-title="Edit" class="edit btn text-white btn-info btn-sm mt-1 editClub"><i class="far fa-edit"></i> Edit</a>';
                $delete = '<a href="javascript:void(0)" data-toggle="tooltip" data-id="' . $data->id . '" data-original-title="Delete" class="delete btn text-white btn-danger btn-sm mt-1 deleteClub"><i class="fas fa-trash"></i> Delete</a>';

                return $edit . ' ' . $delete;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function getClubs()
    {
        $clubs = Club::all();

        return $clubs;
    }

    public function storeClub(array $data)
    {
        Club::create($data);
    }

    public function getClubById($id)
    {
        $club = Club::findOrFail($id);

        return $club;
    }

    public function updateClub(Club $club, array $data)
    {
        $club->club_name = $data['club_name'] ?? $club->club_name;
        $club->city = $data['city'] ?? $club->city;

        $club->save();

        return $club;
    }

    public function deleteClub(Club $club)
    {
        $club->delete();
    }
}
