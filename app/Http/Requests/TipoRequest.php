<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class TipoRequest extends Request
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
        $idTipo = $this->route('tipo');
        return [
            'nombre' => 'required|string|min:2|max:25|unique:tipos,nombre,'.$idTipo,
            'horas_reales' => 'numeric|min:0',
        ];
    }
}
