<?php namespace Infoclinic\Model;

use Illuminate\Database\Eloquent\Model;

class Estado extends Model {

	protected $fillable=['nome','uf','pais_id'];

	public function registroRegional(){
	    return $this->hasMany(RegistroRegional::Class);
    }

}
