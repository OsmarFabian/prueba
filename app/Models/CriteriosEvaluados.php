<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CriteriosEvaluados extends Model
{
	protected $table='desgolce_evaluacion_criterios';
	public $timestamps =false;
	protected $fillable = [ 
		'calificacion', 'criterio', 'evaluacion'
	];

	public function que_criterio()
	{
	    return $this->hasOne('App\Models\CriteriosConsiderar', 'id', 'criterio');
	} 

}