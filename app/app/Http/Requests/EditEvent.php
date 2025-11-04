<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use App\Event;

class EditEvent extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if ($this->route('id')) {
            $event = Event::find($this->route('id'));
            return $event && $event->user_id === auth()->id();
        }

        return false;
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
            'comment' => 'required|max:300',
            'date' => 'required|date',
            'format' => 'required',
            'type' => 'required',
        ];
    }
}
