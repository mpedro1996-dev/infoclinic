<?php

namespace Infoclinic\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DiasAtendimentoRequest extends FormRequest
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
            'dia_semana'=>'unique_with:dias_atendimento,vinculo_id,'.$this->get('id'),
            'horario_inicio'=>'required',
            'horario_fim'=>'required'
        ];
    }

    public function messages()
    {
        return [
            'vinculo_id.required'=>'O vínculo não pode ser nulo.',
            'dia_semana.unique_with'=>'Você já cadastrou um horário para esse dia de semana.',
            'horario_inicio.required'=>'O horário de inicial de atendimento na clínica deve ser preenchido.',
            'horario_fim.required'=>'O horário de término de atendimento na clínica deve ser preenchido'
        ];
    }
}
