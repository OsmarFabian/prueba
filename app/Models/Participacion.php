<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Participacion extends Model
{

	public $timestamps =false;
	
	protected $table='participacion';
//    public $timestamps =false;
	protected $fillable = [
    'proyecto_id', 'participante', 'institucion', 'rol', 'actividades'];
    //
}
