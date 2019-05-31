<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CriteriosConsiderar extends Model
{
	protected $table='catalogo_criterios';
	public $timestamps =false;
	protected $fillable = [ 
//		'grupo', 'aspecto','auxiliar'
		'grupo', 'aspecto', 'alternativo', 'tipo'
		//tipo = ENUM('NORMAL', 'BOLEANO')
	];
}
