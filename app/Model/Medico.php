<?php namespace Infoclinic\Model;

use Infoclinic\User;
use Illuminate\Database\Eloquent\Model;

class Medico extends Model {
    public function registroRegional(){
        return $this->hasMany(RegistroRegional::class);
    }
    public function usuario(){
        return $this->hasOne(User::class);
    }

}
