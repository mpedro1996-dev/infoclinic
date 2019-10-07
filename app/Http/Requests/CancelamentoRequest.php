<?php

namespace Infoclinic\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CancelamentoRequest extends FormRequest
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
            'justificativa'=>'required|max:255'
        ];
    }
    public function messages(){
        return[
        	'justificativa.max'=>'O campo Justificativa deve possuir no máximo 255 caracteres.',
            'justificativa.required'=>'É necessário preencher a justificativa para o cancelamento.'
        ];
    }
}
