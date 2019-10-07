<?php namespace Infoclinic\Model;

use Infoclinic\User;
use Illuminate\Database\Eloquent\Model;

class Clinica extends Model {
	protected $fillable = ['cnpj','razao_social','descricao','horario_inicio_func','horario_fim_func',
        'data_inauguracao','domingo','segunda','terca','quarta','quinta','sexta','sabado','cep_clinica',
        'logradouro_clinica','numero_clinica','bairro_clinica','complemento_clinica',
        'cidade_clinica','estado_clinica','administrador_id'];
    protected $protected = ['id'];

    public function administrador(){
		return $this->belongsTo(Administrador::class);
	}
	public function usuario(){
        return $this->hasOne(User::class);
    }
    public function atendente(){
        return $this->hasMany(Atendente::class);
    }

    public function vinculos(){
        return $this->hasMany(Vinculo::class,'vinculo_id','id');
    }
}
