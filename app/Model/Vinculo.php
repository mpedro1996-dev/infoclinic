<?php

namespace Infoclinic\Model;

use Illuminate\Database\Eloquent\Model;

class Vinculo extends Model
{
    protected $table = 'vinculos';
    protected $fillable = ['registro_id','clinica_id'];

    public function clinica(){
        return $this->belongsTo(Clinica::class,'clinica_id','id');
    }

    public function diasAtendimento(){
        return $this->hasMany(DiasAtendimento::class,'vinculo_id','id');
    }

    public function registroEspecialidades(){
        return $this->belongsToMany(RegistrosRegionalEspecialidade::class,'vinculos_registro_especialidades','vinculo_id','registro_especialidade_id')->using(VinculoRegistroEspecialidade::class)->withTimestamps();
    }
    public function registroRegional(){
        return $this->belongsTo(RegistroRegional::class,'registro_id','id');
    }
}

