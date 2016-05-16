<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CarreraRequest extends Request
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
            'codigo' => 'required|string|min:5|max:15',
            'nombre' => 'required|string|min:2|max:25',
            'color_hexa' => 'string|min:3|max:7',
            'costo_mensual' => 'required|numeric|min:0',
        ];
    }
}
