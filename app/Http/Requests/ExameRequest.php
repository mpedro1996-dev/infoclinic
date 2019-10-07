<?php

namespace Infoclinic\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExameRequest extends FormRequest
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
            'descricao'=>'required|min:3|max:255',
            'nome_arquivo'=>'max:255',
        ];
    }

    public function messages(){
        return[
            'descricao.required'=>'O campo Descrição deve ser preenchido.',
            'descricao.max'=>'O campo Descrição deve possuir no máximo 255 caracteres.',
			'nome_arquivo.max'=>'O campo Nome do Arquivo deve possuir no máximo 255 caracteres.',
			'descricao.min'=>'O campo Descrição deve possuir no mínimo 3 caracteres.'
        ];
    }
}