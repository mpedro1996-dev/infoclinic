<?php namespace Infoclinic\Model;

use Illuminate\Database\Eloquent\Model;

class Pais extends Model {

    protected $table = "paises";

	protected $fillable=['nome','sigla'];

}
