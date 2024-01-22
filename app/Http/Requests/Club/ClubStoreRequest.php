<?php

namespace App\Http\Requests\Club;

use Illuminate\Foundation\Http\FormRequest;

class ClubStoreRequest extends FormRequest
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
            'club_name' => 'required|string|max:255|unique:clubs,club_name',
            'city' => 'required|string|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'club_name.required' => 'The Club name already been taken',
        ];
    }
}
