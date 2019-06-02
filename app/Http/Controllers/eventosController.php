<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Evento;

class EventosController extends Controller{

function agregar_evento()
{
	$Eventos = Evento::all();
	return view ('sistema.crear_evento',compact('Eventos'));
}	



	function agregar(Request $datos)
	{
		$_POST = $datos->toArray();
		$nuevo = new Evento();
		$nuevo->fill($_POST);
		$nuevo->save();
		return redirect('/crear_evento');
	}
/*

	function agregar_ajax(Request $datos)
	{
		$_POST = $datos->toArray();
		$nuevo = new Evento();
		$nuevo->fill($_POST);
		$nuevo->save();


		return response()->json( array( 'nuevo' => $nuevo, 'nombre' => $nuevo->quien->nombre) );
	}

	function eliminar($id){
		$seleccionado = Evento::find($id);
		$seleccionado->delete();
		return redirect('/clientes');
	}

	function eliminar_ajax(Request $datos){
		$_POST = $datos->toArray();

		try {
			$seleccionado = Evento::find($_POST['id']);
			$seleccionado->delete();
			return response()->json( array('error'=>false, 'eliminado' => $seleccionado, 'nombre' => $seleccionado->quien->nombre) );

		} catch (\Exception $e) {
            
            $error = $e->getMessage();
            $num   = $e->getCode();
            if ($num == 23000) 
            			return response()->json( array( 'error'=>true, 'numero' => $num, 'mensaje' => 'Ese cliente esta en uso') );
            else
            			return response()->json( array( 'error'=>true, 'numero' => $num, 'mensaje' => $error) );
    }
	}

function actualiza_nombre(Request $datos)
	{
		$_POST = $datos->toArray();

		$_POST = $datos->toArray();
		$nuevo = Cliente::find($_POST["id"]);
		$nuevo->nombre=$_POST["nombre"];
		$nuevo->save();
		return $nuevo->toJson();
	}













/////////

	function modificar($id){

		$seleccionado = Carro::find($id);
		return view ('modificar',compact('seleccionado'));

	}

	function procesar2(Request $datos)
	{
		$_POST = $datos->toArray();
		$nuevo = Carro::find($_POST["id"]);
		$nuevo->marca=$_POST["marca"];
		$nuevo->modelo=$_POST["modelo"];
		$nuevo->linea=$_POST["linea"];
		$nuevo->save();
		return redirect('/carro_agregar');
	}


*/

}