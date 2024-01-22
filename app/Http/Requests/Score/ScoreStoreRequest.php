<?php

namespace App\Http\Requests\Score;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ScoreStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'home_club_id' => 'required|exists:clubs,id',
            'away_club_id' => [
                'required',
                'exists:clubs,id',
                Rule::unique('scores')->where(function ($query) {
                    $query->where(function ($subQuery) {
                        $subQuery->where('home_club_id', $this->input('home_club_id'))
                            ->where('away_club_id', $this->input('away_club_id'));
                    })->orWhere(function ($subQuery) {
                        $subQuery->where('home_club_id', $this->input('away_club_id'))
                            ->where('away_club_id', $this->input('home_club_id'));
                    });
                }),
            ],
            'home_score' => 'required|integer|min:0',
            'away_score' => 'required|integer|min:0',
        ];
    }

    public function messages(): array
    {
        return [
            'home_club_id.required' => 'Please choose the home club.',
            'home_club_id.exists' => 'Please choose the home club.',
            'away_club_id.required' => 'Please choose the away club.',
            'away_club_id.exists' => 'Please choose the away club.',
            'away_club_id.unique' => 'The match between selected clubs has already been played.',
            'home_score.required' => 'Please fill in the home score.',
            'away_score.required' => 'Please fill in the away score.',
        ];
    }
}
