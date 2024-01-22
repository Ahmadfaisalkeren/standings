<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Standing extends Model
{
    use HasFactory;

    protected $fillable = [
        'score_id',
        'club_id',
        'game_played',
        'win',
        'draw',
        'lose',
        'goal_scored',
        'goal_conceded',
        'points',
    ];

    public function club()
    {
        return $this->belongsTo(Club::class);
    }
}
