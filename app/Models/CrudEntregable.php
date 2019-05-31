<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CrudEntregable extends Model
{
  protected $table='catalogo_entregables';
  public $timestamps =false;

 protected $fillable = [
       'descripcion', 'tipo'];
}
