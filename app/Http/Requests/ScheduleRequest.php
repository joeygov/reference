<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ScheduleRequest extends FormRequest
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
        $req = \Request::route();

        if ($req->action['as'] == 'schedule.store' || $req->action['as'] == 'schedule.update') {
            $validate =  [
                'start_date' => 'required|date',
                'account_id' => 'required',
                'is_flex' => 'required',
            ];
        }else {
            $validate =  [
                'start_date' => 'nullable|date',
            ];
        }

        return $validate;
    }
}
