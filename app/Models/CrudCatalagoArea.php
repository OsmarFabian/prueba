<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class CrudCatalagoArea extends Model
{
    protected $table='catalogo_areas';
    protected $fillable = ['area'];
      public $timestamps =false;

}
