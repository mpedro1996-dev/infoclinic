<?php namespace Infoclinic\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

class ClinicasRequest extends FormRequest {

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
	public function rules(){
		return[
			'nome' => 'sometimes|required|max:100',
			'telefone'=>'sometimes|required|max:13',
			'celular'=>'sometimes|required|max:14',
			'rg'=>'required|max:20',
			'data_nascimento'=>'required|max:10',
			'cep'=>'sometimes|required|max:9',
			'logradouro'=>'sometimes|required|max:100',
			'numero'=>'sometimes|required|max:10',
			'bairro'=>'sometimes|required|max:80',
			'complemento'=>'max:100',
			'cidade'=>'sometimes|required|max:40',
			'estado'=>'sometimes|required|max:2',
			'email' => 'sometimes|required|email|max:100|unique:usuarios,email,'.$this->get('id'),

			'cnpj'=>'sometimes|required|max:18|unique:clinicas,cnpj,'.$this->get('id'),
            'razao_social'=>'sometimes|required|max:100',
            'data_inauguracao'=>'sometimes|required|max:10',
            'descricao'=>'max:255',
            'horario_inicio_func'=>'sometimes|required',
			'horario_fim_func'=>'sometimes|required',
			'administrador_id'=>'required',
			'cep_clinica'=>'sometimes|max:9',
			'logradouro_clinica'=>'sometimes|max:100',
			'numero_clinica'=>'sometimes|max:10',
			'bairro_clinica'=>'sometimes|max:80',
			'complemento_clinica'=>'max:100',
			'cidade_clinica'=>'sometimes|max:40',
			'estado_clinica'=>'sometimes|max:2'
		];
	}
	public function messages(){
		return[
			'unique:usuarios'=>':attribute já existente.',
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

			'administrador_id.required'=>'Informe o Administrador.',
			'cnpj.required'=>'O campo CNPJ da Clínica deve ser preenchido.',
			'razao_social.required'=>'O campo Razão Social deve ser preenchido.',
			'cnpj.max'=>'O campo CNPJ da Clínica deve possuir no máximo 18 caracteres.',
			'razao_social.max'=>'O campo Razão Social deve possuir no máximo 100 caracteres.',
			'data_inauguracao'=>'O campo Data de Inauguração da Clínica deve ter no máximo 10 caracteres.',
			'cep_clinica.max'=>'O campo CEP da Clínica deve possuir no máximo 9 caracteres.',
			'logradouro_clinica.max'=>'O campo Logradouro da Clínica deve possuir no máximo 100 caracteres.',
			'numero_clinica.max'=>'O campo Número da Clínica deve possuir no máximo 10 caracteres.',
			'bairro_clinica.max'=>'O campo Bairro da Clínica deve possuir no máximo 80 caracteres.',
			'complemento_clinica.max'=>'O campo Complemento da Clínica deve possuir no máximo 100 caracteres.',
			'cidade_clinica.max'=>'O campo Cidade da Clínica deve possuir no máximo 40 caracteres.',
			'estado_clinica.max'=>'O campo Estado da Clínica deve possuir no máximo 2 caracteres.'
		];

	}

}
