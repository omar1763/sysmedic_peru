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

  $comisioneslab = DB::table('atencion_servicios as a')
        ->select('a.id','a.id_servicio','a.id_profesional','a.id_atencion','a.origen','a.created_at as fecha','a.pagado','a.id_sucursal','a.id_empresa','a.porcentaje','b.costo','b.id_atencion','b.id_paciente','e.nombres','e.apellidos','f.name as profnombre','f.apellidos as profapellido', 'a.recibo')
        ->join('atencion_detalles as b','a.id_atencion','b.id_atencion')
        //->join('atencion_profesionales_servicios as c','a.id_profesional','c.id_profesional')
        //->join('servicios as d','d.id','c.id_servicio')
        ->join('pacientes as e','e.id','b.id_paciente')
        ->join('profesionales as f','f.id','a.id_profesional')
        //->groupBy('a.id','a.id_profesional')
        ->where('a.pagado','=',1)
        ->where('a.id_empresa','=', $usuarioEmp)
        ->where('a.id_sucursal','=', $usuarioSuc)
        ->whereBetween('a.created_at', [$f1, $f2]);
        

        $comisionespagadas = DB::table('atencion_laboratorios as a')
        ->select('a.id','a.id_analisis','a.id_profesional','a.id_atencion','a.origen','a.created_at as fecha','a.pagado','a.id_sucursal','a.id_empresa','a.porcentaje','b.costo','b.id_atencion','b.id_paciente','e.nombres','e.apellidos','f.name as profnombre','f.apellidos as profapellido', 'a.recibo')
        ->join('atencion_detalles as b','a.id_atencion','b.id_atencion')
        //->join('atencion_profesionales_laboratorios as c','a.id_profesional','c.id_profesional')
       // ->join('analises as d','d.id','c.id_laboratorio')
        ->join('pacientes as e','e.id','b.id_paciente')
        ->join('profesionales as f','f.id','a.id_profesional')
        ->where('a.pagado','=',1)
        ->where('a.id_empresa','=', $usuarioEmp)
        ->where('a.id_sucursal','=', $usuarioSuc)
        ->whereBetween('a.created_at', [$f1, $f2])
        ->union($comisioneslab)
       // ->where('a.created_at','=', $f1)
        ->orderby('fecha','desc')
        ->get();

        $comisionespagadas = json_encode($comisionespagadas);
        $comisionespagadas = self::unique_multidim_array(json_decode($comisionespagadas, true), "id_atencion");

        return view('existencias.comisionespagadas.index', compact('comisionespagadas'));
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
