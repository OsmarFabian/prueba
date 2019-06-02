<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
//	protected $table='Clientes';
	public $timestamps =false;
	protected $fillable = [ 'fecha', 'hora', 'tipo', 'precio', 'quien_contrato', 'confirmado', 'cliente_id'];



}