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

        switch ($logeado->rol) 
        {
            case 'Cliente':
                $hoy = date("Y-m-d");
                return view('sistema.cliente');                
                break;

            case 'Empleado':
                $hoy = date("Y-m-d");
                return view('sistema.empleado');
                break;
                
            case 'Gerente':
                $hoy = date("Y-m-d");
                return view('sistema.gerente');
                break; 

            default:
                return view('sistema.home');
                break;
        }
    }
}
