<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CursoRequest extends Request
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
        $codigoCurso = $this->route('curso');
        return [
            'codigo' => 'required|string|min:5|max:15|unique:cursos,codigo,'.$codigoCurso.',codigo',
            'nombre' => 'required|string|min:2|max:25|unique:cursos,nombre,'.$codigoCurso.',codigo',
            'color_hexa' => 'string|min:3|max:7',
            'costo_personalizado' => 'required|numeric|min:0',
            'costo_referencial' => 'required|numeric|min:0',
            'eslogan' => 'string|min:2|max:50',
            'descripcion' => 'string',
            'horas_academicas' => 'required|numeric|min:0',
            'horas_reales' => 'required|numeric|min:0',
            'area_id' => 'required|exists:areas,id',
            'dificultad_id' => 'required|exists:dificultades,id',
        ];
    }
}
