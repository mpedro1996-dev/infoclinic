<?php

namespace Infoclinic\Model;

use Illuminate\Database\Eloquent\Model;

class Consulta extends Model
{

    const AGENDADO = 1;
    const AGUARDANDO = 2;
    const ABERTO = 3;
    const FECHADO = 4;
    const CANCELADO = 5;
    const FALTA = 6;

    protected $table = 'consultas';
    protected $fillable = ['queixa_principal','principais_sintomas','exame_fisico','hipotese_diagnostica','orientacao','justificativa','agendamento_id','retorno_id','paciente_id','especialidade_id','status'];

    public function paciente(){
        return $this->belongsTo(Paciente::class,'paciente_id','id');
    }

    public function agendamento(){
        return $this->belongsTo(Agendamento::class,'agendamento_id','id');
    }

    public function especialidade(){
        return $this->belongsTo(Especialidade::class,'especialidade_id','id');
    }

    public function prescricoes(){
        return $this->hasMany(Prescricao::class,'consulta_id','id');
    }

    public function retorno(){
        return $this->hasOne(Consulta::class,'retorno_id','id');
    }

}
