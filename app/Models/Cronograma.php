<?php
/*
////CRONOGRAMA
id, actividad, fecha_inicio, fecha_fin, monto, proyecto_id, entregables_id

*/
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cronograma extends Model
{
    protected $table='cronograma';
    public $timestamps =false;

   protected $fillable = [
	'actividad', 'fecha_inicio', 'fecha_fin', 'proyecto_id', 'entregables_id'];

	public function entregable(){
		return 
		   $this->hasOne('App\Models\Entregables', 'id', 'entregables_id')
		   ->withDefault( ['descripcion'=>'Sin entregable']);
		   //id, tipo, cuantos, descripcion, proyecto_id
	}

	public function gastos()
	{
	    return $this->hasMany('App\Models\Gastos');
	}

	public function total()
	{
			$suma=0;
	    $gastos = $this->gastos;
      foreach ($gastos as $gasto) {
        $suma += $gasto->monto;
      }
      return $suma;
	}
}
