<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Entregables extends Model
{
    protected $table='entregables';
    public $timestamps =false;

   protected $fillable = [
         'tipo', 'cuantos', 'descripcion', 'proyecto_id'];

}
