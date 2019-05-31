<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CrudGastos extends Model
{
    protected $table='catalogo_gastos';
    public $timestamps =false;



   protected $fillable = [
         'descripcion', 'partida'];

}
