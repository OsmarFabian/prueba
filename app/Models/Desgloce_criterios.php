<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Desgloce_criterios extends Model
{
  protected $table='desgolce_evaluacion_criterios';
  protected $fillable = [ 'calificacion', 'criterio', 'evaluacion'];
  public $timestamps =false;
}


