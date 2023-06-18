<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DataRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|min:3',
            'gender' => 'required|regex:/^(Male|male|MALE|Female|FEMALE|female)$',
            'telephone' => 'required|unique:users,telephone|regex:/^1-?\(?\d{3}(\)|-|\.)?\d{3}(-|\.)?\d{4}$',
            'stateNumberRF' => 'required|regex:/^[A-Z]{1}-\d{3}-[A-Z]{2}$',
        ];
    }
}
