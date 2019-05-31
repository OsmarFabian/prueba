<?php

namespace App\Models;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Seguimiento extends Model
{

	public $timestamps =false;
	
	protected $table='seguimiento';
//    public $timestamps =false;
	protected $fillable = [
    'id', 'proyecto', 'revisor', 'primera', 'segunda', 'final'];
    //
    public function proyectos()
  {
      return $this->hasMany('App\Models\Proyecto');
  }             

}
