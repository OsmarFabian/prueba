<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Aval extends Model
{
    protected $table='proyecto';
    public $timestamps =false;

   protected $fillable = [
         'aval'];

}
