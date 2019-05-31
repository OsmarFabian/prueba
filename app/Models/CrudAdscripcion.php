<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CrudAdscripcion extends Model
{
  protected $table='catalogo_ies';
  protected $fillable = ['ies'];
    public $timestamps =false;
}
