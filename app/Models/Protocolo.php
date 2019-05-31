<?php
/*
////protocolo
resumen, introduccion, antecedentes, hipotesis, marco_teorico, 
metas, objetivo_general, objetivos_especificos, impacto_beneficio, 
metodologia, vinculacion, referencias, lugar, infraestrucutura

*/
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Protocolo extends Model
{
    protected $table='proyecto';
//    public $timestamps =false;

   protected $fillable = [
	'resumen', 'introduccion', 'antecedentes', 'hipotesis', 'marco_teorico', 
	'objetivo_general', 'objetivos_especificos', 'impacto_beneficio', 
	'metodologia', 'referencias', 'lugar', 'infraestructura','tvinculacion'];

	public function convocatoria(){
		return 
		  $this->belongsTo('App\Models\Convocatoria', 'convocatoria_id');
	}

	public function director(){
		return 
		   $this->hasOne('App\Models\User', 'id', 'responsable');
	}

	public function colaboradores()
	{
	    return $this->hasMany('App\Models\Colaboradores');
	}        

	public function entregables()
	{
	    return $this->hasMany('App\Models\Entregables');
	}        

	public function programa_educativo(){
		return 
		   $this->hasOne('App\Models\Programa_educativo', 'id', 'pe');
	}
}
