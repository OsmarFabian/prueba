<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Colaboradores extends Model
{
    protected $table='colaboradores';
    public $timestamps =false;

   protected $fillable = [
         'users_id', 'proyecto_id','participacion'];

	public function proyecto(){
		return 
		  $this->belongsTo('App\Models\Proyecto', 'proyecto_id');
	}

	public function quien(){
		return 
		   $this->hasOne('App\Models\User', 'id', 'users_id');
	}
	
}
