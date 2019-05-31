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
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Convocatoria;
use App\Models\Gastos;
use App\Models\Colaboradores;
use App\Models\Entregables;
use App\Models\Cronograma;
use App\Models\Seguimiento;

class Proyecto extends Model
{
    protected $table='proyecto';
//    public $timestamps =false;

   protected $fillable = [
    'titulo', 'financiado', 'nombre_ies', 'pe', 'area', 
    'linea', 'fecha_inicio', 'fecha_fin', 
    'convocatoria_id', 'responsable', 'tipo_investigacion',
    'sera_finciado','aprobado'];


	public function convocatoria(){
		return 
		  $this->belongsTo('App\Models\Convocatoria', 'convocatoria_id');
	}

	public function seguimiento(){
		return 
		  $this->belongsTo('App\Models\Seguimiento', 'seguimiento_id');
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

//      return $this->hasMany('App\Models\Proyecto')->where('sometido','<>','NULL');

	public function cuanto_cuesta()
	{
		return $this->hasMany('App\Models\Gastos')->sum('monto');
/*

    $sometidos = DB::table('gastos')
                       ->where('proyecto_id',$this->id )
                       ->select('id as sometido_id') //, DB::raw('MAX(created_at) as last_post_created_at')
*/
	}        


	public function actividades()
	{
	    return $this->hasMany('App\Models\Cronograma')->orderBy('fecha_inicio', 'asc');

	}        

	public function programa_educativo(){
		return 
		   $this->hasOne('App\Models\Programa_educativo', 'id', 'pe');
	}

	public function evaluaciones(){
		return 
		   $this->hasMany('App\Models\Evaluacion', 'proyecto', 'id');
	}

	public function Ejercicio(){

		return substr($this->fecha_inicio, 0,4);
	}

	public function mio($id){
		if ($this->responsable == $id) return true;
		else return false;
	}

	public function tengo($id){
		if ($this->responsable == $id) return true;
		else{
			foreach ($this->colaboradores as $colaborador) {
				if ($colaborador->users_id == $id) return true;
			}
			return false;
		}
	}

	public function acepte($id){
		foreach ($this->colaboradores as $colaborador) {
			if ($colaborador->users_id == $id && $colaborador->participacion == 1) return true;
			if ($colaborador->users_id == $id && $colaborador->participacion == "") return false;
		}
		return false;
	}

	public function esta_sometido(){
		if ( $this->sometido == "" ) return false;
		else return true;
	}
	public function esta_aprobado(){
		if ( $this->dictamen >= 70) return true;
		else return false;
		
	}
	public function en_evaluacion(){
	  $hoy = date("Y-m-d");
	  $en = true;
//		if ($hoy >= $this->convocatoria->Fecha_eval_inicio && $hoy <= $this->convocatoria->Fecha_eval_fin) $en = true;
		if ($this->sometido != "" && $this->dictamen == "" && $en ) return true;
		return false;
	}
	public function evaluado(){
	  $hoy = date("Y-m-d");
	  $en = true;
		if ($hoy >= $this->convocatoria->Fecha_eval_inicio && $hoy <= $this->convocatoria->Fecha_eval_fin) $en = true;

		if ($this->sometido != "" && $this->dictamen != "" ) return true;
		return false;
	}

	public function activo(){
	  $agno = new \DateTime($this->convocatoria->Fecha_inicio); // Today
	  $a = $agno->format('Y'); // echos today!
		
    $hoy = date("Y");

    if ($hoy == $a ) return true;
  	else return false;

	}

	public function evaluable(){
    $hoy = date("Y-m-d");
		if ($hoy >= $this->convocatoria->Fecha_eval_inicio && $hoy <= $this->convocatoria->Fecha_eval_fin) return true;
		else return false;
	}


	public function en_convocatoria(){		
    $hoy = date("Y");
		if ($hoy >= $this->convocatoria->Fecha_inicio && $hoy <= $this->convocatoria->Fecha_fin) return true;
		else return false;
	}
	public function opciones_anteproyecto(){
    return array(  
      "Información básica" => "/proyecto/" . $this->id ,
      "Protocolo"=> "/protocolo/" . $this->id , 
      "Colaboradores" => "/colaboradores/" . $this->id ,
      "Entregables" => "/entregables/" . $this->id  ,
      "Actividades" => "/cronograma/" . $this->id ,
      "Presupuesto" => "/gastos/" . $this->id  ,
      "Vinculación" => "/vinculacion/" . $this->id ,
      "Aval de académia" => "/aval/" . $this->id ,
      "Someter" => "/someter/" . $this->id,
      "separacion",
      "CI-01" => "/pdfci01/" . $this->id ,
      "CI-02" => "/pdfci02/" . $this->id ,


    );
	}
	public function opciones_seguimiento()
	{
		return array(
        "Dictamen" => "/dictamen/" . $this->id ,
        "CI-02" => "/pdfci02/" . $this->id ,
        "1er reporte parcial" => "/reporte01/" . $this->id ,
        "2do reporte parcial" => "/reporte02/" . $this->id ,
      );
	}


	public function validar_en_convocatoria(){		
    $hoy = date("Y-m-d");
		if ($hoy >= $this->convocatoria->Fecha_inicio && $hoy <= $this->convocatoria->Fecha_fin) return true;
		else return false;
	}




}
