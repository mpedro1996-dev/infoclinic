<?php namespace Infoclinic\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

class MedicosRequest extends FormRequest {

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
            'cpf' => 'sometimes|required|max:14|unique:pacientes,cpf,'.$this->get('id'),
            'nome' => 'sometimes|required|max:255',
            'telefone'=>'sometimes|required|max:13',
            'celular'=>'sometimes|required|max:14',
            'rg'=>'max:255',
            'cep'=>'sometimes|required|max:9',
            'logradouro'=>'sometimes|required|max:255',
            'numero'=>'sometimes|required',
            'bairro'=>'sometimes|required|max:255',
            'complemento'=>'max:255',
            'cidade'=>'sometimes|required|max:255',
            'estado'=>'sometimes|required|max:255',
            'email' => 'sometimes|required|email|max:255|unique:usuarios,email,'.$this->get('id'),
            'password' => 'sometimes|required|confirmed|min:6',

        ];
	}
    public function messages(){
        return [
            'required'=>'O campo :attribute deve ser preenchido',
            'unique:usuarios'=>':attribute já existente',
            'password.required'=>'O campo Senha deve ser preenchido',
        ];
    }

}
