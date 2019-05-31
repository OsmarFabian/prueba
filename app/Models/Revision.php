<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Revision extends Model
{

	public $timestamps =false;
	
	protected $table='revisiones';
//    public $timestamps =false;
	protected $fillable = [
    'id', 'fecha', 'avance', 'ejercido', 'resumen', 'observaciones', 'reviso'];
    //
}
