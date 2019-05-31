<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gastos extends Model
{
    protected $table='gastos';
    public $timestamps =false;



   protected $fillable = [
         'descripcion', 'partida', 'monto', 'actividad_id', 'proyecto_id', 'ejercido'];

	public function actividad(){
		return 
		  $this->belongsTo('App\Models\Cronograma', 'cronograma_id');
	}


}
