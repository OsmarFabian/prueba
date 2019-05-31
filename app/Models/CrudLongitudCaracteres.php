<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

//para que esta el modelo "RestriccionesL" entonces

class CrudLongitudCaracteres extends Model
{
    protected $table='catalogo_restricciones_longitud';
      protected $fillable = ['valor'];
        public $timestamps =false;
}
