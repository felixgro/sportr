<?php

namespace App\Http\Requests\Team;

use Illuminate\Foundation\Http\FormRequest;

class EditTeam extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return \Auth::user()->can('edit-team');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'sometimes|required|string',
            'sport_id' => 'sometimes|required|exists:sports,id'
        ];
    }
}
