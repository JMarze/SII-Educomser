<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CronogramaRequest extends Request
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
            'inicio_carrera' => 'required',
            'inicio' => 'required|date',
            'duracion_clase' => 'required|numeric|min:0|max:8',
            'costo' => 'required|numeric|min:0',
            'costo_mensual' => 'numeric|min:0',
            'matricula' => 'numeric|min:0',
            'promocion' => 'required',
            'slider' => 'required',
            'tipo_id' => 'required|exists:tipos,id',
            'curso_codigo' => 'required|exists:cursos,codigo',
        ];
    }
}
