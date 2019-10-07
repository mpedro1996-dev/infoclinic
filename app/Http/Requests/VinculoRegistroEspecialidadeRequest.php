<?php

namespace Infoclinic\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VinculoRegistroEspecialidadeRequest extends FormRequest
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
            'vinculo_id'=>'required',
            'registro_especialidade_id'=>'required|unique_with:vinculos_registro_especialidades,vinculo_id'
        ];
    }
    public function messages()
    {
        return [
            'registro_especialidade_id.unique_with'=>'Você já cadastrou a especialidade para esse registro'

        ];
    }
}
