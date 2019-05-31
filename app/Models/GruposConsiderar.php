<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class GruposConsiderar extends Model
{
	protected $table='catalogo_grupos';
	public $timestamps =false;
	protected $fillable = [ 
//		'nombre', 'ponderacion', 'amerita_obs','auxiliar'
		'nombre', 'ponderacion', 'manera', 'amerita_obs', 'alternativo'
	];

	public function criterios()
	{
		return $this->hasMany('App\Models\CriteriosConsiderar','grupo');
	}        
}
