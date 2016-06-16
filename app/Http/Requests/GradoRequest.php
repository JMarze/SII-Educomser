<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class GradoRequest extends Request
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
        $idGrado = $this->route('grado');
        return [
            'descripcion' => 'required|string|min:2|max:25|unique:tipos,nombre,'.$idGrado,
            'abreviatura' => 'string|min:2|max:10',
        ];
    }
}
