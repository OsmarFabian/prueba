<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GruposEvaluados extends Model
{
	protected $table='desgloce_evaluacion_grupos';
	public $timestamps =false;
	protected $fillable = [ 
		'observaciones', 'grupo', 'obtenido', 'evaluacion'
	];

	public function que_grupo()
	{
	    return $this->hasOne('App\Models\GruposConsiderar', 'id', 'grupo');
	} 

}