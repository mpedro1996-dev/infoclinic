<?php namespace Infoclinic\Http\Requests;


use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest {

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
		return[

			'nome' => 'sometimes|required|max:100',
			'telefone'=>'sometimes|required|max:13',
			'celular'=>'sometimes|required|max:14',
			'rg'=>'required|max:20',
            'data_nascimento'=>'required|max:10|before:'.Carbon::today(),
			'cep'=>'sometimes|required|max:9',
			'logradouro'=>'sometimes|required|max:100',
			'numero'=>'sometimes|required|max:10',
			'bairro'=>'sometimes|required|max:80',
			'complemento'=>'max:100',
			'cidade'=>'sometimes|required|max:40',
			'estado'=>'sometimes|required|max:2',
			'email' => 'sometimes|required|email|max:100|unique:usuarios,email,'.$this->get('id'),
			'cpf'=>'required|unique:pacientes,cpf,'.$this->get('id'),
			'tipo_sanguineo'=>'max:2',
			'fator_rh'=>'max:1',
			'sexo'=>'required',
			'estado_civil'=>'required',
            'peso'=>'numeric|min:0.01|required',
            'altura'=>'numeric|min:0.01|required',

		];
	}
	
	public function messages(){
		return[
			'unique:usuarios'=>':attribute já existente.',
			'cpf.required'=>'O campo CPF deve ser preenchido.',
			'nome.required'=>'O campo Nome deve ser preenchido.',
			'telefone.required'=>'O campo Telefone deve ser preenchido.',
			'celular.required'=>'O campo Celular deve ser preenchido.',
			'rg.required'=>'O campo RG deve preenchido.',
			'data_nascimento.required'=>'O campo Data de Nascimento deve ser preenchido.',
			'cep.required'=>'O campo CEP deve possuir deve ser preenchido.',
			'logradouro.required'=>'O campo Logradouro deve ser preenchido.',
			'numero.required'=>'O campo Número deve ser preenchido.',
			'bairro.required'=>'O campo Bairro deve ser preenchido.',
			'cidade.required'=>'O campo Cidade deve ser preenchido.',
			'estado.required'=>'O campo Estado deve ser preenchido.',
			'email.required'=>'O campo E-mail deve ser preenchido.',
			'tipo_sanguineo.max'=>'O campo Tipo Sanguíneo deve ser preenchido.',
			'fator_rh.max'=>'O campo Fator RH deve ser preenchido.',
			'sexo.required'=>'O campo Sexo deve ser preenchido.',
			'estado_civil.required'=>'O campo Estado Civil deve ser preenchido.',
			'peso.required'=>'O campo Peso deve ser preenchido.',
			'altura.required'=>'O campo Altura deve ser preenchido.',
            'data_nascimento.before'=>'A data de nascimento tem que ser anterior a hoje.',


            'nome.max'=>'O campo Nome deve possuir no máximo 100 caracteres.',
			'telefone.max'=>'O campo Telefone deve possuir no máximo 13 caracteres.',
			'celular.max'=>'O campo Celular deve possuir no máximo 14 caracteres.',
			'rg.max'=>'O campo RG deve possuir no máximo 20 caracteres.',
			'data_nascimento.max'=>'O campo Data de Nascimento deve ter no máximo 10 caracteres.',
			'cep.max'=>'O campo CEP deve possuir no máximo 9 caracteres.',
			'logradouro.max'=>'O campo Logradouro deve possuir no máximo 100 caracteres.',
			'numero.max'=>'O campo Número deve possuir no máximo 10 caracteres.',
			'bairro.max'=>'O campo Bairro deve possuir no máximo 80 caracteres.',
			'complemento.max'=>'O campo Complemento deve possuir no máximo 100 caracteres.',
			'cidade.max'=>'O campo Cidade deve possuir no máximo 40 caracteres.',
			'estado.max'=>'O campo Estado deve possuir no máximo 2 caracteres.',
			'email.max'=>'O campo E-mail deve possuir no máximo 100 caracteres.',
            'altura.min'=>'Altura não pode ser negativa.',
            'peso.min'=>'Peso não pode ser negativo.',
		];

	}

}
