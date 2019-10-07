<?php namespace Infoclinic\Model;

use Infoclinic\User;
use Illuminate\Database\Eloquent\Model;

class Paciente extends Model {

	protected $fillable=['cpf','tipo_sanguineo','fator_rh','estado_civil','sexo','altura','peso'];
	protected $protected=['id'];
	public function usuario(){
		return $this->hasOne(User::class);
	}	
}
