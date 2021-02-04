<?php

namespace App\Http\Requests\Event;

use App\Models\Location;
use Illuminate\Foundation\Http\FormRequest;

class EditEvent extends FormRequest
{
    use EventValidators;

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
            'title' => ['sometimes', 'required', 'string'],
            'date' => ['sometimes', 'required', 'date'],
            'teams' => ['required', 'array'],
            'teams.*' => ['required', 'array', fn (...$args) => $this->validateTeams(...$args)],
            'location' => ['sometimes', 'required', fn (...$args) => $this->validateLocation(...$args)]
        ];
    }
}
