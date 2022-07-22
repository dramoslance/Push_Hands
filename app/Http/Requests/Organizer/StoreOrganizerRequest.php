<?php

namespace App\Http\Requests\Organizer;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrganizerRequest extends FormRequest
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
            'portrait' => 'string|max:255',
            'name' => 'string|required',
            'description' => 'string|required',
            'email' => 'string|required|email|unique:organizers',
            'phone' => 'string|required',
            'website' => 'string'
        ];
    }
}
