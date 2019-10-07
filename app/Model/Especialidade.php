<?php namespace Infoclinic\Model;

use Illuminate\Database\Eloquent\Model;

class Especialidade extends Model {

    protected $table='especialidades';
    protected $fillable=['nome','descricao'];

    public function registrosRegionalEspecialidades(){
        return $this->hasMany(RegistrosRegionalEspecialidade::class,'especialidade_id','id');
    }

}
