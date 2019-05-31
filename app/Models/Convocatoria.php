<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Convocatoria extends Model
{
  protected $table='convocatoria';
  public $timestamps =false;
  protected $fillable = [ 
    'Nombre', 'Fecha_inicio', 'Fecha_fin', 
    'Fecha_eval_inicio', 'Fecha_eval_fin'
  ];

	public function proyectos()
	{
	    return $this->hasMany('App\Models\Proyecto');
	}
    public function revisiones()
  {
      return $this->hasMany('App\Models\Seguimiento');
  }             
  public function sometidos()
  {
      return $this->hasMany('App\Models\Proyecto')->where('sometido','<>','NULL');
  }
  public function pidieron()
  {
      return $this->hasMany('App\Models\Proyecto')->where('sometido','<>','NULL')->where('financiado','1');
    //regresa un Illuminate\Database\Eloquent\Collection
    //regresa un Illuminate\Database\Eloquent\Collection
  }          
  public function institucional_pidieron()
  {
      $prjs = $this->pidieron;
      $sum = 0;
//      var_dump($prjs);
      foreach ($prjs as $prj ) {
              $sum += $prj->gastos->sum('monto');
      }
      return $sum;      
    //regresa un Illuminate\Database\Eloquent\Collection
    //regresa un Illuminate\Database\Eloquent\Collection
  }          
  


  public function aprobados()
  {
      return $this->hasMany('App\Models\Proyecto')->where('aprobado','1');
  }        
  public function rechazados()
  {
      return $this->hasMany('App\Models\Proyecto')->where('aprobado','0')->where('dictamen','<>','NULL');
  }        
  public function afinaciar()
  {
      return $this->hasMany('App\Models\Proyecto')->where('aprobado','1')->where('sera_financiado','1');
      //regresa un Illuminate\Database\Eloquent\Collection
  }        
  public function institucional_afinaciar()
  {
      $prjs = $this->afinaciar;
      $sum = 0;
      foreach ($prjs as $prj ) {
              $sum += $prj->gastos->sum('monto');
      }
      return $sum;      
  }          

	public function vigente(){

        $ConvocatoriaFechaInicio = new \DateTime($this->Fecha_inicio);
        $ConvocatoriaFechaFin  = new \DateTime($this->Fecha_fin);
        $fechaHoy = new \DateTime(); // Today
        $fechaHoy->format('d/m/Y'); // echos today!

        if(
          $fechaHoy->getTimestamp() >= $ConvocatoriaFechaInicio->getTimestamp() &&
          $fechaHoy->getTimestamp() <= $ConvocatoriaFechaFin->getTimestamp() ){
			return true;
		}else{
 	       return false;
        }
	}

  public function pe_invoulcrados(){

    /*
    //SELECT pe.nombre, p.linea, p.sometido,  p.titulo, p.financiado, p.aprobado, p.sera_financiado
    //FROM proyecto as p JOIN catalogo_pe as pe ON p.pe = pe.id
    $prjs = DB::table('proyecto as p')
      ->select('p.id as pid', 'nivel', 'programa', 'linea', 'sometido',  'titulo', 'financiado', 'aprobado', 'sera_financiado') //, DB::raw('MAX(created_at) as last_post_created_at')
      ->where('convocatoria_id',$this->id )
      ->where('sometido','<>', 'NULL')
      ->join('catalogo_pe as pe', 'p.pe', '=', 'pe.id')
      ;
    return $prjs->get();
    */

/*
  SELECT pe, p.id as pid, sometido, finaciado, aprobado, sera_financiado
  ->where('convocatoria_id',$this->id )

  SELECT nivel, programa, p.id as pid, sometidos, finaciados, aprobados, afinanciar
  FROM proyecto as p JOIN catalaogo_pe as pe ON p.pe = pe.id

*/
     $involucrados = DB::table('proyecto as p')
      ->select('pe', DB::raw('count(p.id) as registrados, count(sometido) as sometidos, sum(financiado) as financiados, sum(aprobado) as aprobados, count(sera_financiado) as financiar') ) // 'p.id as pid', 'linea', 'titulo', //, 
      ->where('convocatoria_id',$this->id )
      ->groupBy('pe')
      ->leftJoin('catalogo_pe as cpe', 'p.pe', '=', 'cpe.id')
      //->orderBy('registrados')
      ;


    $departamentos = DB::table('catalogo_pe')
            ->select('nivel', 'programa','registrados', 'sometidos', 'financiados', 'aprobados', 'financiar') 
            ->leftjoinSub($involucrados, 'subquery01', function ($join) {
                $join->on('catalogo_pe.id', '=', 'subquery01.pe');
            });


    return $departamentos->get();




  }
  public function cevaluaciones(){
    $sometidos = DB::table('proyecto')
                       ->select('id as sometido_id') //, DB::raw('MAX(created_at) as last_post_created_at')
                       ->where('convocatoria_id',$this->id )
                       ->where('sometido','<>', 'NULL');


    $evaluador_evaluados = DB::table('evaluacion')
            ->select('evaluador as evaluador_evaluados_id', DB::raw('count(*) as evaluados   ')) //aque es evaluados
            ->where('calificacion','<>',NULL)
            ->groupBy('evaluador')
            ->joinSub($sometidos, 'subquery01', function ($join) {
                $join->on('evaluacion.proyecto', '=', 'subquery01.sometido_id');
            });


    $evaluador_asignados = DB::table('evaluacion')
            ->select('evaluador as evaluador_asignados_id', DB::raw('count(*) as asignados'))
            ->groupBy('evaluador')
            ->joinSub($sometidos, 'subquery01', function ($join) {
                $join->on('evaluacion.proyecto', '=', 'subquery01.sometido_id');
            });



    $users = DB::table('users')
            ->select(DB::raw("CONCAT(cvutecnm, ' ' , users.name, ' ' , lastname) as nombre, asignados, evaluados, file_cvu as area, email") )
            ->orderBy('file_cvu')
            ->where('rol','Evaluador')
            ->leftjoinSub($evaluador_evaluados, 'subconsulta01', function ($join) {
                $join->on('users.id', '=', 'subconsulta01.evaluador_evaluados_id');
            })
            ->leftjoinSub($evaluador_asignados, 'subconsulta02', function ($join) {
                $join->on('users.id', '=', 'subconsulta02.evaluador_asignados_id');
            });

            return $users->get();
  }





}
