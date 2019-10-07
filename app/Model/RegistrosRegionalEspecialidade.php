<?php

namespace Infoclinic\Model;

use Illuminate\Database\Eloquent\Model;

class RegistrosRegionalEspecialidade extends Model
{
    protected $fillable = ["registros_regional_id","especialidade_id"];
    protected $primaryKey = "id";


    public function registroRegional(){
        return $this->belongsTo(RegistroRegional::class,'registros_regional_id','id');
    }
    public function especialidade(){
        return $this->belongsTo(Especialidade::class,'especialidade_id','id');
    }
    public function vinculos(){
        return $this->belongsToMany(Vinculo::class,'vinculos_registro_especialidades','registro_especialidade_id','vinculo_id')->using(VinculoRegistroEspecialidade::class)->withTimestamps();
    }


}
