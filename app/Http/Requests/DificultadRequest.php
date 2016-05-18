<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class DificultadRequest extends Request
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
        $idDificultad = $this->route('dificultad');
        return [
            'nombre' => 'required|string|min:2|max:25|unique:dificultades,nombre,'.$idDificultad,
        ];
    }
}
