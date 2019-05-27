<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestRolUpdate extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        return [
            'titulo'=>'required|unique:rols',
            'descripcion'=>'required',
        ];
    }
}
