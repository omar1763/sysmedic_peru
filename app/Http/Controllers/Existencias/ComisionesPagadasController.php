<?php

namespace App\Http\Controllers\Existencias;

use App\Atencion;
use App\AtencionDetalle;
use App\AtencionLaboratorio;
use App\AtencionProfesionalesServicio;
use App\AtencionProfesionalesLaboratorio;
use App\Pacientes;
use App\Profesionales;
use App\Analisis;
use App\Debitos;
use App\Empresas;
use App\Locales;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;


class ComisionesPagadasController extends Controller
{
    /**
     * Display a listing of User.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (! Gate::allows('users_manage')) {
            return abort(401);
        }

        
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
        
      /*  $comisionespagadas = DB::table('atencion_profesionales_servicios as a')
        ->select('a.id','a.id_servicio','a.id_profesional','a.id_servicio','a.created_at as fecha','a.pagado','a.id_sucursal','a.id_empresa','b.costo','b.id_paciente','d.detalle','d.porcentaje','e.nombres','e.apellidos','f.name as profnombre','f.apellidos as profapellido')
        ->join('atencion_detalles as b','a.id','b.id_atencion')
        ->join('servicios as d','d.id','a.id_servicio')
        ->join('pacientes as e','e.id','b.id_paciente')
        ->join('profesionales as f','f.id','a.id_profesional')
        ->where('a.pagado','=',1)
        ->where('a.id_empresa','=', $usuarioEmp)
        ->where('a.id_sucursal','=', $usuarioSuc)
        ->whereBetween('a.created_at', [$f1, $f2])
        //->where('a.created_at','=', $f1)
        ->orderby('a.created_at','desc')
        ->paginate(5000);

         $comisionespagadaslab = DB::table('atencion_profesionales_laboratorios as a')
        ->select('a.id','a.id_profesional','a.id_laboratorio','a.created_at as fecha','a.pagado','a.id_sucursal','a.id_empresa','b.costo','b.id_paciente','d.name','d.porcentaje','e.nombres','e.apellidos','f.name as profnombre','f.apellidos as profapellido')
        ->join('atencion_detalles as b','a.id','b.id_atencion')
        ->join('analises as d','d.id','a.id_laboratorio')
        ->join('pacientes as e','e.id','b.id_paciente')
        ->join('profesionales as f','f.id','a.id_profesional')
        ->where('a.pagado','=',1)
        ->where('a.id_empresa','=', $usuarioEmp)
        ->where('a.id_sucursal','=', $usuarioSuc)
        ->whereBetween('a.created_at', [$f1, $f2])
       // ->where('a.created_at','=', $f1)
        ->orderby('a.created_at','desc')
        ->paginate(5000);
        */
       $comisiones_lab_pag = DB::table('atencion_profesionales_laboratorios as a')
     ->select(DB::raw('SUM(a.pagar) as total_lab','id_empresa','a.pagado','a.id_sucursal','a.id','a.created_at as fecha'))
     ->where('a.id_empresa','=', $usuarioEmp)
     ->where('a.id_sucursal','=', $usuarioSuc)
     ->where('a.pagado','=',1)
     //->havingRaw('SUM(a.pagar) > ?', [0])
     ->get();

      $comisiones_serv_pag = DB::table('atencion_profesionales_servicios as a')
     ->select(DB::raw('SUM(a.pagar) as total_serv','id_empresa','a.pagado','a.id_sucursal','a.id','a.created_at as fecha'))
     ->where('a.id_empresa','=', $usuarioEmp)
     ->where('a.id_sucursal','=', $usuarioSuc)
     ->where('a.pagado','=',1)
     //->havingRaw('SUM(a.pagar) > ?', [0])
     ->get();

    $comisiones_lab = DB::table('atencion_profesionales_laboratorios as a')
        ->select('a.id','a.recibo', 'a.id_atencion', 'a.id_laboratorio as id_servicio', 'a.pagado', 'a.porcentaje',
        'a.recibo', 'a.created_at as fecha', 'a.montolab as costo', 'f.name as nombres',
        'f.apellidos as apellidos', 's.origen', 'p.nombres as pnombres', 'p.apellidos as papellidos')
        ->join('profesionales as f','f.id','a.id_profesional')
        ->join('atencion_detalles as b','a.id_atencion','b.id_atencion')
        ->join('pacientes as p','p.id','b.id_paciente')
        ->join('atencion_laboratorios as s', 'a.id_atencion', 's.id_atencion')
        ->groupBy('a.recibo')
        ->where('a.pagado','=',1)
        ->where('a.id_empresa','=', $usuarioEmp)
        ->where('a.id_sucursal','=', $usuarioSuc)
        ->whereBetween('a.created_at', [$f1, $f2]);

        $comisionespagadas = DB::table('atencion_profesionales_servicios as a')
        ->select('a.id','a.recibo', 'a.id_atencion', 'a.id_servicio', 'a.pagado', 'a.porcentaje', 'a.recibo', 'a.created_at as fecha', 'a.montoser as costo', 'f.name as nombres', 'f.apellidos as apellidos', 's.origen', 'p.nombres as pnombres', 'p.apellidos as papellidos')
        ->join('profesionales as f','f.id','a.id_profesional')
        ->join('atencion_detalles as b','a.id_atencion','b.id_atencion')
        ->join('pacientes as p','p.id','b.id_paciente')
        ->join('atencion_servicios as s', 'a.id_atencion', 's.id_atencion')
        ->groupBy('a.recibo')
        ->where('a.id_empresa','=', $usuarioEmp)
        ->where('a.id_sucursal','=', $usuarioSuc)
        ->where('a.pagado', '=', 1)
        ->whereBetween('a.created_at', [$f1, $f2])
        ->union($comisiones_lab)
        ->distinct()->get();

      
        $comisionespagadas = json_encode($comisionespagadas);
        $comisionespagadas = self::unique_multidim_array(json_decode($comisionespagadas, true), "id_atencion");

        return view('existencias.comisionespagadas.index', compact('comisionespagadas','comisiones_lab_pag','comisiones_serv_pag'));
    }
 
  static function unique_multidim_array($array, $key) {
    $temp_array = array();
    $i = 0;
    $key_array = array();
   
    foreach($array as $val) {
        if (!in_array($val[$key], $key_array)) {
            $key_array[$i] = $val[$key];
            $temp_array[$i] = $val;
        }
        $i++;
    }
    return $temp_array;
  }     

}
