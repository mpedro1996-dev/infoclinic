<?php namespace Infoclinic\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

class RegistroRegionalRequest extends FormRequest {

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
			'medico_id'=>'required',
			'tipo_registro'=>'required|max:10',
            'numero'=>'required|max:30',
            'estado_id'=>'required'
		];
	}
	public function messages(){
	    return[
	    	'medico_id.required'=>'Informe o Médico.',
	    	'estado_id.required'=>'Informe o Estado.',
	        'tipo_registro.required'=>'O campo Tipo do Registro deve ser preenchido.',
            'numero.required'=>'O campo Número do Registro deve ser preenchido.',
            'tipo_registro.max'=>'O campo Tipo de Registro deve possuir no máximo 10 caracteres.',
            'numero.max'=>'O campo Número de Registro deve possuir no máximo 30 caracteres.'
        ];
    }

}
