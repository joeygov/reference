<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OverBreakRequest extends FormRequest
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
    public function rules()
    {
        return [
            'overbreak_date' => 'nullable|date',
            'employee' => 'required',
            'break1' => 'nullable|date_format:h:i:s A',
            'break2' => 'nullable|date_format:h:i:s A',
            'break3' => 'nullable|date_format:h:i:s A',
            'break4' => 'nullable|date_format:h:i:s A',
        ];
    }
}
