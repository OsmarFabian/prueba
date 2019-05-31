<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Programa_educativo extends Model
{
	protected $table='catalogo_pe';
	public $timestamps =false;
	protected $fillable = [
//          'programa', 'nivel', 'actreditado_habilitado', 'pnpc'
					'programa', 'nivel', 'actreditado_habilitado', 'pnpc', 'institucion'          
  ];


  public function lineas()
	{
	    return $this->hasMany('App\Models\CrudLineas','pe_id');
	}        

	public function ies(){
		return 
		  $this->belongsTo('App\Models\CrudAdscripcion', 'institucion');
	}

}
