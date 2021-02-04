<?php

namespace App\Http\Requests\Location;

use Illuminate\Foundation\Http\FormRequest;

class EditLocation extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return \Auth::user()->can('edit-event');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'sometimes|required|string|unique:sports',
            'address' => 'sometimes|required',
            'zip' => 'sometimes|required',
            'city' => 'sometimes|required',
            'country' => 'sometimes|required'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'title.unique' => 'A sport with that title already exists.',
        ];
    }
}
