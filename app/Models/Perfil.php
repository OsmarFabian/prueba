<?php
/*


*/
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Perfil extends Model
{
    protected $table='users';
//    public $timestamps =false;

   protected $fillable = [
	  'file_cvu','updated_cvu'
	 ];


}
