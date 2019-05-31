<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RestriccionesR extends Model
{
    protected $table='catalogo_restricciones_registro';
    public $timestamps =false;

   protected $fillable = [ 'descripcion'];


/*
	public function restricciones()
	{
	    return $this->hasMany('App\Models\RestriccionesDesgloce');
	}        
*/

}