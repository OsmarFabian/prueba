<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RestriccionesL extends Model
{
    protected $table='catalogo_restricciones_longitud';
    public $timestamps =false;

   protected $fillable = [ 'descripcion', 'valor', 'auxiliar' ];

}