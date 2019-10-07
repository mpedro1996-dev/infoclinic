<?php namespace Infoclinic\Model;

use Infoclinic\User;
use Illuminate\Database\Eloquent\Model;

class Administrador extends Model {

	protected $table = "administradores";
	protected $fillable = ['permissao_especial'];

	public function usuario(){
		return $this->hasOne(User::class);
	}
	public function clinica(){
		return $this->hasMany(Clinica::class);
	}
}
