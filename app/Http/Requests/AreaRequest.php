<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class AreaRequest extends Request
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
        $idArea = $this->route('area');
        return [
            'nombre' => 'required|string|min:2|max:25|unique:areas,nombre,'.$idArea,
        ];
    }
}
