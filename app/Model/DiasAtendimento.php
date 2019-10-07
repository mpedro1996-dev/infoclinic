<?php

namespace Infoclinic\Model;

use Illuminate\Database\Eloquent\Model;

class DiasAtendimento extends Model
{
    protected $table = 'dias_atendimento';
    protected $fillable = ['vinculo_id', 'dia_semana', 'horario_inicio', 'horario_fim'];

    public function vinculo(){
        return $this->belongsTo(Vinculo::class,'vinculo_id','id');
    }
}
