<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class pruebasController extends Controller
{
	//
	public function recibirPost(){
    // en este punto del código $request es mi objeto HTTP Request. (inyectado)
/*	echo $request->path();
    echo "<br>";
    echo $request->url();
    echo "<br>";
    echo "olv";
*/
    return 'funciona hdp';
}
}
