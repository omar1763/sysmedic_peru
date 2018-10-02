<?php

namespace App\Http\Controllers\Existencias;
use App\AtencionLaboratorio;
use App\AtencionServicios;
use App\Locales;
use App\Empresas;
use App\RedactarResultados;
use App\AtencionDetalle;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\Movimientos\StoreResultadosRequest;
use App\Http\Requests\Movimientos\UpdateResultadosRequest;

class ResultadosGuardadosLabController extends Controller
{
    /**
     * Display a listing of User.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
    	

    	$id_usuario = Auth::id();

    	$searchUsuarioID = DB::table('users')
    	->select('*')
                   // ->where('estatus','=','1')
    	->where('id','=', $id_usuario)
    	->get();

    	foreach ($searchUsuarioID as $usuario) {
    		$usuarioEmp = $usuario->id_empresa;
    		$usuarioSuc = $usuario->id_sucursal;
    	}


    	$f1 = date('YYYY-m-d');
    	$f2 = date('YYYY-m-d');

    	$f1 = $request->fecha;
    	$f2 = $request->fecha2;

    
    	  $laboratorios = DB::table('atencion_profesionales_laboratorios as a')
                ->select('a.id','a.id_atencion','a.id_laboratorio','a.pagado','a.id_empresa','a.id_profesional','a.id_sucursal','a.created_at','d.name as detalleservicio','e.id_paciente','f.nombres','f.apellidos','a.status_redactar_resultados','g.name','g.apellidos as ape')
                ->join('empresas as b','a.id_empresa','b.id')
                ->join('locales as c','a.id_sucursal','c.id')
                ->join('analises as d','a.id_laboratorio','d.id')
                ->join('atencion_detalles as e','a.id_atencion','e.id_atencion')
                ->join('pacientes as f','f.id','e.id_paciente')
                ->join('profesionales as g','g.id','a.id_profesional')
                ->where('a.status_redactar_resultados','=',1)
                ->where('a.id_empresa','=', $usuarioEmp)
                ->where('a.id_sucursal','=', $usuarioSuc)
                ->whereBetween('a.created_at', [$f1, $f2])
                ->orderby('a.created_at','desc')
                ->get();

        


    	return view('existencias.resultadosguardadoslab.index', compact('laboratorios'));
    }

 

}
