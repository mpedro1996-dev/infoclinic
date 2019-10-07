<?php

namespace Infoclinic\Model;

use Illuminate\Database\Eloquent\Model;

class LinhasProntuario extends Model
{
    protected $table = "linhas_prontuario";
    protected $fillable = ["exame_id","consulta_id",'paciente_id','bloqueado'];


    public function exame(){
        return $this->belongsTo(Exame::class,'exame_id','id');
    }

    public function paciente(){
        return $this->belongsTo(Paciente::class,'paciente_id','id');
    }

    public function consulta(){
        return $this->belongsTo(Consulta::class,'consulta_id','id');
    }



}
