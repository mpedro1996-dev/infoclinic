<?php

namespace Infoclinic\Model;

use Illuminate\Database\Eloquent\Relations\Pivot;

class VinculoRegistroEspecialidade extends Pivot
{
    protected $table = 'vinculos_registro_especialidades';
    protected $fillable = ['vinculo_id','registro_especialidade_id'];

}
