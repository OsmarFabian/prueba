<?php

namespace App\Http\Controllers\Investigador;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Passwords;
use App\Models\User;
use App\Models\Perfil;

class PerfilController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Muestra por los datos del usuario al que se cambiara el password.
     *
     * @param request
     * @return json con los datos del usuario modificado
     */
    public function cambiar(Request $request, $id)
    {
				$user = User::find($id);
				return view('crudusers/cambiar', compact('user', 'id'));
    }

    /**
     * Muestra por los datos del usuario al que se cambiara el password.
     *
     * @param request
     * @return json con los datos del usuario modificado
     */
    public function actualizar(Request $request, $id)
    {

		$Usuarios = Passwords::find($id);	
        $campos = $request->all();
        $puede = false;
        if ( !Hash::check($campos['pwda'],$Usuarios->password)) {
          return redirect('home')->with('error', 'El password anterior no coincide con el guardado en la b.d.');
        }
        if ($campos['pwd2'] != $campos['password']){
            return redirect('home')->with('error', 'El nuevo password no se repitio correctamente.');
        }
        $campos['password'] = Hash::make($campos['password']);
        $Usuarios->fill($campos);
        $Usuarios->save();
        return redirect('home')->with('success','Password actualizado correctamente');
    }




    public function mostrar($idusr)
    {
        $perfil= perfil::find($idusr);
        $investigador= User::find($idusr);
        return view('perfil/show',compact('investigador','perfil'));
    }


    public function agregar(Request $request)
    {
        $idusr = $request->input('user_id');
        $file = $request->file('evidencia');
        $investigador= User::find($idusr);

        $extension = "";
        $extension = $file->getClientOriginalExtension();
        $fileName = 'cvu_' . $investigador->cvutecnm  . '.' . $extension;
        
////////
        if (Storage::disk('local')->exists($fileName) ) {
                $mensa = "existe un previo";
            $ret = Storage::disk('local')->delete($fileName) ;
            if(! $ret){
              //problema no se borro
                $mensa .= "y no se borro";
              return json_encode(array(
               'error' => true, 
               'mensaje' => "No es posible borrar el curriculum existente",
               'path' => $fileName
              ));
            }else{
                $mensa .= "y si se borro";
            } 
        }else{
                $mensa = "no existe un previo";
        }
////////        
        $path = Storage::putFileAs(
            '', $request->file('evidencia'), $fileName
        );

/*  return json_encode(array(
   'error' => true, 
   'mensaje' => "$mensa",
   'path' => $fileName
  ));
*/
        try {
            DB::beginTransaction();    
            $Perfil= Perfil::find($idusr);
            $Perfil->file_cvu = $path;
            $Perfil->updated_cvu = date('Y-m-d H:i:s');
            $Perfil->save();
            $path = public_path() . '/evidencias\/' . $path;
            $Retornar = array(
                'fileName' => $fileName,
                'idusr' => $idusr,
                'path' => $path
            );
            DB::commit();
            return json_encode(array(
                     'error' => false, 
                     'mensaje' => $Retornar,
                     'path' => $path
 ));
        } catch (\Exception $e) {
            $error = $e->getMessage();
            DB::rollback();
            return response()->json( array(
                     'error' => true, 
                     'mensaje' => 'DB::. ' . $error));
        }
    }







}