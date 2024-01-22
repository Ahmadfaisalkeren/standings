<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    use HasFactory;

    protected $fillable = ['home_club_id', 'away_club_id', 'home_score', 'away_score'];

    public function homeClub()
    {
        return $this->belongsTo(Club::class, 'home_club_id');
    }

    public function awayClub()
    {
        return $this->belongsTo(Club::class, 'away_club_id');
    }

    public function getResultAttribute()
    {
        return $this->homeClub->club_name . ' ' . $this->home_score . ' VS ' . $this->away_score . ' ' . $this->awayClub->club_name;
    }

    public function getOpponentGoals($clubId)
    {
        if ($this->home_club_id === $clubId) {
            return $this->away_score;
        } else {
            return $this->home_score;
        }
    }
}
