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
        
      
        
        $comisiones_lab_pag = DB::table('atencion_profesionales_laboratorios as a')
        ->select(DB::raw('SUM(a.pagar) as total_lab','id_empresa','a.pagado','a.id_sucursal','a.id','a.created_at as fecha','a.updated_at'))
        ->where('a.id_empresa','=', $usuarioEmp)
        ->where('a.id_sucursal','=', $usuarioSuc)
        ->whereBetween('a.updated_at', [$f1, $f2])
        ->where('a.pagado','=',1)
     //->havingRaw('SUM(a.pagar) > ?', [0])
        ->get();

        $comisiones_serv_pag = DB::table('atencion_profesionales_servicios as a')
        ->select(DB::raw('SUM(a.pagar) as total_serv','id_empresa','a.pagado','a.id_sucursal','a.id','a.created_at as fecha','a.updated_at'))
        ->where('a.id_empresa','=', $usuarioEmp)
        ->where('a.id_sucursal','=', $usuarioSuc)
        ->where('a.pagado','=',1)
        ->whereBetween('a.updated_at', [$f1, $f2])
     //->havingRaw('SUM(a.pagar) > ?', [0])
        ->get();

        $comisiones_lab = DB::table('atencion_profesionales_laboratorios as a')
        ->select('a.id','a.recibo', 'a.id_atencion', 'a.id_laboratorio as id_servicio','a.fecha_pago_comision', 'a.pagado', 'a.porcentaje',
        'a.recibo', 'a.created_at as fecha','a.updated_at', 'a.montolab as costo', 'f.name as nombres',
        'f.apellidos as apellidos', 's.origen', 'p.nombres as pnombres', 'p.apellidos as papellidos')
        ->join('profesionales as f','f.id','a.id_profesional')
        ->join('atencion_detalles as b','a.id_atencion','b.id_atencion')
        ->join('pacientes as p','p.id','b.id_paciente')
        ->join('atencion_laboratorios as s', 'a.id_atencion', 's.id_atencion')
        ->where('a.pagado','=',1)
        ->where('a.id_empresa','=', $usuarioEmp)
        ->where('a.id_sucursal','=', $usuarioSuc)
        ->groupBy('a.recibo')
        ->whereBetween('a.fecha_pago_comision', [$f1, $f2]);
        //->groupBy('recibo');

        $comisionespagadas = DB::table('atencion_profesionales_servicios as a')
        ->select('a.id','a.recibo', 'a.id_atencion', 'a.id_servicio','a.fecha_pago_comision', 'a.pagado', 'a.porcentaje', 'a.recibo', 'a.created_at as fecha','a.updated_at','a.montoser as costo', 'f.name as nombres', 'f.apellidos as apellidos', 's.origen', 'p.nombres as pnombres', 'p.apellidos as papellidos')
        ->join('profesionales as f','f.id','a.id_profesional')
        ->join('atencion_detalles as b','a.id_atencion','b.id_atencion')
        ->join('pacientes as p','p.id','b.id_paciente')
        ->join('atencion_servicios as s', 'a.id_atencion', 's.id_atencion')
        ->where('a.id_empresa','=', $usuarioEmp)
        ->where('a.id_sucursal','=', $usuarioSuc)
        ->where('a.pagado', '=', 1)
        ->whereBetween('a.fecha_pago_comision', [$f1, $f2])
        ->union($comisiones_lab)
        ->groupBy('a.recibo')
        ->get();


        
      
         $comisionespagadas = json_encode($comisionespagadas);
         $comisionespagadas = self::unique_multidim_array(json_decode($comisionespagadas, true), "recibo");

        return view('existencias.comisionespagadas.index', compact('comisionespagadas','f1','comisiones_lab_pag','comisiones_serv_pag'));
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
