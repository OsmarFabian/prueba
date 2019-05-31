<?php
/*
////Información básica del proyecto
id, titulo, nombre_ies, nombre_pe, area, 
actreditado_habilitado, pnpc, linea, 
fecha_inicio, fecha_fin, financiado, duracion, convocatoria_id, responsable, 
tipo_investigacion, sometido, dictamen, 
*/
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Someter extends Model
{
    protected $table='proyecto';
//    public $timestamps =false;

   protected $fillable = [
    'ci01', 'ci02', 'sometido'];

	public function convocatoria(){
		return 
		  $this->belongsTo('App\Models\Convocatoria', 'convocatoria_id');
	}

	public function director(){
		return 
		   $this->hasOne('App\Models\User', 'id', 'responsable');
	}

	public function colaboradores()
	{
	    return $this->hasMany('App\Models\Colaboradores');
	}        


	public function entregables()
	{
	    return $this->hasMany('App\Models\Entregables');
	}        

	public function gastos()
	{
	    return $this->hasMany('App\Models\Gastos');
	}        


	public function actividades()
	{
	    return $this->hasMany('App\Models\Cronograma');
	}        

	public function programa_educativo(){
		return 
		   $this->hasOne('App\Models\Programa_educativo', 'id', 'pe');
	}
}
