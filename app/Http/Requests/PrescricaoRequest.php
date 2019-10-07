<?php

namespace Infoclinic\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PrescricaoRequest extends FormRequest
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
            'nome_remedio'=>'required|max:100',
            'quantidade'=>'required|max:5',
            'unidade_medida'=>'required|max:100',
            'periodo'=>'required|max:255',
            'consulta_id'=>'required'
        ];
    }

    public function messages()
    {
        return [
            'nome_remedio.required'=>'O campo Medicamento deve ser preenchido.',
            'quantidade.required'=>'O campo Quantidade deve ser preenchido.',
            'unidade_medida.required'=>'O campo Forma Farmacêutica deve ser preenchido.',
            'periodo.required'=>'O campo Período deve ser preenchido.',
            'consulta_id.required'=>'Informe a Consulta.',
            'nome_remedio.max'=>'O campo Nome do Remédio deve possuir no máximo 100 caracteres.',
            'quantidade.max'=>'O campo Quantidade deve possuir no máximo 5 caracteres.',
            'unidade_medida.max'=>'O campo Forma Farmacêutica deve possuir no máximo 100 caracteres.',
            'periodo.max'=>'O campo Período deve possuir no máximo 255 caracteres.'
        ];
    }
}
