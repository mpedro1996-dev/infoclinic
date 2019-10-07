<?php

namespace Infoclinic\Model;

use Illuminate\Database\Eloquent\Model;

class Exame extends Model
{
    protected $table = "exames";
    protected $fillable = ['descricao','nome_arquivo'];

    public function linhasProntuario(){
        return $this->hasOne(LinhasProntuario::class,'exame_id','id');
    }
}
