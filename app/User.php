<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
         'name', 'email','rol', 'password',        
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function adscription(){
/*
        return $this->hasOne('App\Models\Programa_educativo', 'id', 'adscripcion')
        ->withDefault( ['nivel'=>'sn', 'programa'=>'sp']);
*/
        switch ($this->rol) {
            case 'Revisor':
                return $this->hasOne('App\Models\Programa_educativo', 'id', 'adscripcion')
                        ->withDefault( ['nivel'=>'sn', 'programa'=>'sp']);
                break;

            case 'Evaluador':
                return $this->adscripcion;
                break;
                
            case 'Investigador':
                return $this->hasOne('App\Models\Programa_educativo', 'id', 'adscripcion')
                        ->withDefault( ['nivel'=>'sn', 'programa'=>'sp']);
                break;

                break;
            case 'Coordinador':
                return $this->hasOne('App\Models\CrudAdscripcion', 'id', 'adscripcion')
                        ->withDefault( ['nivel'=>'sn', 'programa'=>'sp']);
                break;
            default:
                return "sin adscripcion";
                break;
        }
    }



    public function actualizo_cvu($cuando)
    {

        $updated = new \DateTime($this->updated_cvu);
        $updated = $updated->getTimestamp();
        $fecha = new \DateTime($cuando);
        $fecha = $fecha->getTimestamp();


        if( is_null($this->updated_cvu) ){
            return false;   
        }elseif( $updated >= $fecha  ){
            return true;
        }else{
            return false;
        }
        
    }

    



}
