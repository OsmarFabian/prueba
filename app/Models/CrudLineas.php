<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CrudLineas extends Model
{
  protected $table='catalogo_lineas';
  protected $fillable = ['linea','pe_id'];
  public $timestamps =false;
	
	public function pe(){
	return 
	  $this->belongsTo('App\Models\Programa_educativo', 'pe_id')
	  ->withDefault( ['programa'=>'Sin Asignar']);
	}

}
