<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
//	protected $table='Clientes';
	public $timestamps =false;
	protected $fillable = [ 'fecha', 'tipo', 'cliente_id'];

	public function quien(){
		return $this->belongsTo('App\Http\Models\Cliente', 'cliente_id', 'id' );
	}

}