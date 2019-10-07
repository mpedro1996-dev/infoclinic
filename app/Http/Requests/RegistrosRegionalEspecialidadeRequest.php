<?php

namespace Infoclinic\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegistrosRegionalEspecialidadeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true ;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'especialidade_id'=>'required',
            'registros_regional_id'=>'unique_with:registros_regional_especialidades,especialidade_id'
        ];
    }

    public function messages()
    {
        return [
            'registros_regional_id.required'=>'Informe o Registro Regional.',
            'especialidade_id.required'=>'Informe a Especialidade.',
            'registros_regional_id.unique_with'=>'Você já cadastrou a especialidade para esse registro.'
        ];
    }
}
