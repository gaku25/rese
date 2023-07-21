<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReserveRequest extends FormRequest
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
            'date' => 'required|date_format:Y-m-d',
            'time' => 'required|date_format:H:i',
            'number' => 'required|integer',
        ];
    }

    public function messages()
    {
        return [
            'date.required' => '予約日を選択してください。',
            'time.required' => '予約時間を選択してください。',
            'number.required' => '予約人数を選択してください。',
            'number.integer' => '有効な人数を選択してください。',
        ];
    }
}