<?php

namespace App\Http\Requests\Organizer;

use Illuminate\Foundation\Http\FormRequest;

class StoreMemberOrganizerRequest extends FormRequest
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
            'organizer_user_id' => 'numeric|required|exists:App\Models\User,id',
            'organizer_id' => 'numeric|required|exists:App\Models\Organizer,id'
        ];
    }
}