<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Informe extends Model
{
    //
    public $timestamps =false;
	
	protected $table='informe_final';
	protected $fillable = [
    'id', 'reviso', 'resumen', 'alcanzo', 'cumplio', 'metodologia', 'participacion', 'desviaciones', 'cambios', 'difundir', 'manifieste', 'anexo',
	];
}
