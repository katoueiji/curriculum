<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateEvent extends FormRequest
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
     * @return array
     */
    public function rules(): array
    {
        return [
            'capacity' => 'required|integer',
            'title' => 'required|max:100',
            'image' => 'required',
            'comment' => 'required|max:300',
            'date' => 'required|date',
            'format' => 'required',
            'type' => 'required',

        ];
    }
}
