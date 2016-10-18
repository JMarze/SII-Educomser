<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class DocenteRequest extends Request
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
            'primer_apellido' => 'string|max:25',
            'segundo_apellido' => 'string|max:25',
            'nombres' => 'required|string|max:25',
            'fecha_nacimiento' => 'date',
            'numero_ci' => 'required|string|max:15',
            'expedicion_codigo' => 'required',
            'genero' => 'string',
            'direccion' => 'string',
            'telefono_1' => 'string',
            'telefono_2' => 'string',

            'biografia' => 'string|min:15',
        ];
    }
}
