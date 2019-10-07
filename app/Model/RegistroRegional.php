<?php namespace Infoclinic\Model;

use Illuminate\Database\Eloquent\Model;

class RegistroRegional extends Model {
    protected  $table = 'registros_regional';
    protected $fillable = ['medico_id','numero','estado_id','bloqueado','tipo_registro'];

    public function medico(){
        return $this->belongsTo(Medico::class);
    }
    public function registrosRegionalEspecialidades(){
        return $this->hasMany(RegistrosRegionalEspecialidade::class,'registros_regional_id','id');
    }
    public function estado(){
        return $this->belongsTo(Estado::class);
    }
}
