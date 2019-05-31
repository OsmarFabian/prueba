<?php
namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Proyecto;
use App\Models\Convocatoria;
use App\Models\Evaluacion;
use App\Models\Seguimiento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Session;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $logeado = Auth::user();

        //$page solo es usado por el investigador
        if ($request->input('page')) $hayg=true;
        else $hayg = false;
        if (\Session::has('page')) $hays=true;
        else $hays = false;

        if( $hayg == false && $hays == false ){
            $page=true;
        }
        if( $hayg == false && $hays == true  ){
            $page = \Session::get('page');
        }
        if( $hayg == true  && $hays == false ){
            $page=$request->input('page');
            \Session::put('page' ,  $request->input('page') );
        }
        if( $hayg == true  && $hays == true  ){
            $page=$request->input('page');
            \Session::put('page' ,  $request->input('page') );
        }
        $request->merge( array( 'page' => $page ) );

        //$year solo es usado por el coordinador
        if ($request->input('year')) $hayg=true;
        else $hayg = false;
        if (\Session::has('year')) $hays=true;
        else $hays = false;

        if( $hayg == false && $hays == false ){
            $year=2019;
        }
        if( $hayg == false && $hays == true  ){
            $year = \Session::get('year');
        }
        if( $hayg == true  && $hays == false ){
            $year=$request->input('year');
            \Session::put('year' ,  $request->input('year') );
        }
        if( $hayg == true  && $hays == true  ){
            $year=$request->input('year');
            \Session::put('year' ,  $request->input('year') );
        }
        $request->merge( array( 'year' => $year ) );



        switch ($logeado->rol) 
        {
            case 'Revisor':
                $hoy = date("Y-m-d");
                $convocatorias=Convocatoria::orderByDesc("Fecha_inicio")->paginate(5);
                $convocatorias->currentPage($page);
                $seguimientos = Seguimiento::all();    
                return view('sistema.Revisor', compact('convocatorias','hoy','seguimientos'));                
                break;

            case 'Evaluador':
                $hoy = date("Y-m-d");
                $convocatorias=Convocatoria::
                    where("Fecha_eval_inicio",">=", $hoy)->
                    where("Fecha_eval_fin","<=", $hoy)->get();
                $evaluaciones = Evaluacion::where('evaluador',$logeado->id)->get();
                
                return view('sistema.Evaluador',compact('convocatorias','hoy','evaluaciones'));
                break;
                
            case 'Investigador':
                $hoy = date("Y-m-d");
                $convocatorias=Convocatoria::orderByDesc("Fecha_inicio")->paginate(5);
                $convocatorias->currentPage($page);
                return view('sistema.Investigador',compact('convocatorias','hoy'));
                break;
            case 'Coordinador':
                $conv = Convocatoria::all();
                $evaluadores = User::where('rol','Evaluador')->orderBy('file_cvu', 'asc')->get();
                $convocatoriasyear = Convocatoria::whereraw("YEAR(Fecha_inicio)='$year'")->get();
                if(date("Y")==$year) $actual =true;
                else $actual =false ;
                return view('sistema.Coordinador',compact( 'year','convocatoriasyear','evaluadores','actual'));
                break;
            case 'Observador':
                $conv = Convocatoria::all();
                $evaluadores = User::where('rol','Evaluador')->orderBy('file_cvu', 'asc')->get();
                $convocatoriasyear = Convocatoria::whereraw("YEAR(Fecha_inicio)='$year'")->get();
                if(date("Y")==$year) $actual =true;
                else $actual =false ;
                return view('sistema.Observador',compact( 'year','convocatoriasyear','evaluadores','actual'));
                break;                
            default:
                return view('sistema.home');
                break;
        }
    }
}
