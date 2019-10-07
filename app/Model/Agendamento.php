<?php

namespace Infoclinic\Model;

use Illuminate\Database\Eloquent\Model;

class Agendamento extends Model
{
    protected $table = "agendamentos";
    protected $fillable = ['vinculo_id','data_agendamento'];

    public function vinculo(){
        return $this->belongsTo(Vinculo::class,'vinculo_id','id');
    }
}
