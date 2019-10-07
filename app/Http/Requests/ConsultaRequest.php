<?php

namespace Infoclinic\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ConsultaRequest extends FormRequest
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
            'consulta_id'=>'required',
            'queixa_principal'=>'required|min:10|max:1000',
            'orientacao'=>'required|min:10|max:1000',
            'principais_sintomas'=>'max:1000',
            'exame_fisico'=>'required|max:1000',
            'hipotese_diagnostica'=>'max:1000',
            'peso'=>'required',
            'altura'=>'required'
        ];
    }

    public function messages()
    {
        return[
            'queixa_principal.max'=>'O campo Queixa Principal deve possuir no máximo 1000 caracteres.',
            'orientacao.max'=>'O campo Orientação deve possuir no máximo 1000 caracteres.',
            'principais_sintomas.max'=>'O campo Principais Sintomas deve possuir no máximo 1000 caracteres.',
            'exame_fisico.max'=>'O campo Exame Físico deve possuir no máximo 1000 caracteres.',
            'hipotese_diagnostica.max'=>'O campo Hipótese Diagnóstica deve possuir no máximo 1000 caracteres.',
            'queixa_principal.min'=>'O campo Queixa principal deve ter no mínimo 3 caracteres.',
            'orientacao.min'=>'O campo Orientação deve ter no mínimo 3 caracteres.',
            'consulta_id.required'=>'Informe a consulta.',
            'queixa_principal.required'=>'O campo Queixa Principal deve ser preenchido.',
            'orientacao.required'=>'O campo Orientação deve ser preenchido.',
            'peso.required'=>'O campo Peso deve ser preenchido.',
            'altura.required'=>'o campo Altura deve ser preenchido.',
            'exame_fisico.required'=>'O campo Exame Físico deve ser preenchido.'
        ];
    }
}
