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

class ResultadosGuardadosPaqController extends Controller
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

    
          $paquetes = DB::table('atencion_profesionales_paquete_labs as a')
                ->select('a.id', 'a.id_atencion', 'a.id_paquete','a.id_laboratorio','a.id_profesional', 'a.pagado', 'a.porcentajepaq as porcentaje',
                    'a.recibo', 'a.created_at as fecha','a.status_redactar_resultados','a.id_profesional', 'b.costo','b.id_paciente','b.costoa', 'f.name as nombres',
                    'f.apellidos', 'b.origen', 'p.nombres as pnombres', 'p.apellidos as papellidos','c.name as detalle','c.costo as precio','i.name as detalle1','g.name','g.apellidos as ape')
                ->join('profesionales as f','f.id','a.id_profesional')
                ->join('atencion_detalles as b','a.id_atencion','b.id_atencion')
                ->join('pacientes as p','p.id','b.id_paciente')
                ->join('paquetes as c','c.id','a.id_paquete')
                ->join('analises as i','i.id','a.id_laboratorio')
                ->join('profesionales as g','g.id','a.id_profesional')
                ->where('a.status_redactar_resultados','=',1)
                ->where('a.id_empresa','=', $usuarioEmp)
                ->where('a.id_sucursal','=', $usuarioSuc)
                ->orderby('a.id_atencion','DESC')
                ->where('a.created_at','=', $f1)
                ->get();



    	return view('existencias.resultadosguardadospaq.index', compact('paquetes'));
    }

 

}
