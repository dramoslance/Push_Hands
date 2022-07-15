<?php

namespace App\Http\Requests\Organizer;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOrganizerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'organizer_id' => 'required|numeric|exists:App\Models\Organizer,id',
            'language_id' => 'required|numeric|exists:App\Models\Language,id',
            'portrait' => 'string|max:255',
            'name' => 'string|required',
            'description' => 'string|required',
            'email' => 'string|required|email|unique:organizers,email,'. $this->organizer_id,
            'phone' => 'string|required|unique:organizers,phone,'.$this->organizer_id,
            'website' => 'string'
        ];
    }
}
