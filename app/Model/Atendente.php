<?php namespace Infoclinic\Model;

use Infoclinic\User;
use Illuminate\Database\Eloquent\Model;

class Atendente extends Model {
    protected $fillable=['carteira','cnpj','clinica_id'];

    public function clinica(){
        return $this->belongsTo(Clinica::class);
    }
    public function usuario(){
        return $this->hasOne(User::class);
    }

}
