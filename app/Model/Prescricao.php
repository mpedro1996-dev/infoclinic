<?php

namespace Infoclinic\Model;

use Illuminate\Database\Eloquent\Model;

class Prescricao extends Model
{
    protected $table = 'prescricoes';
    protected $fillable = ['nome_remedio','quantidade','unidade_medida','consulta_id','periodo'];
}
