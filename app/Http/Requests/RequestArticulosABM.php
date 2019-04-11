<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestArticulosABM extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        return [
        'fabricante'=>'required',
        'proveedor'=>'required',
        'especialidad'=>'required',
        'medida'=>'required',
        'cod_venta'=>'required',
        'cod_compra'=>'required',
        'descripcion'=>'required',
        'comentarios'=>'required',
        ];
    }
}
