<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEmployeReqeust extends FormRequest
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
            'employe_name' => ['required', 'string', 'max:255'],
            'employe_email' => "required|email|max:128|unique:employes,employe_email,".$this->id.",id",
            'employe_address' => ['required', 'string', 'max:255'],
            'employe_number' => ['required', 'digits_between:8,13'],
        ];
    }
}
