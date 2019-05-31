<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Evaluacion extends Model
{
  protected $table='evaluacion';
	public $timestamps =false;
	protected $fillable = [ 
		'evaluador', 'proyecto', 'calificacion', 'recomendacion', 
		'observaciones', 'aprobado', 'evaluado'		
	];

	public function proyec(){
		return 
		   $this->hasOne('App\Models\Proyecto', 'id', 'proyecto');
	}
	public function eval(){
		return 
		   $this->hasOne('App\Models\User', 'id', 'evaluador');
	}


	public function grupos_evaluados()
	{
	    return $this->hasMany('App\Models\GruposEvaluados','evaluacion');
	}        
	public function criterios_evaluados()
	{
	    return $this->hasMany('App\Models\CriteriosEvaluados');
	}        

}

