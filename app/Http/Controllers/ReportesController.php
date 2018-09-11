<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Support\Facades\Auth;
use Silber\Bouncer\Database\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Atencion;
use App\AtencionDetalle;
use App\AtencionLaboratorio;
use App\AtencionServicios;
use App\AtencionProfesionalesServicio;
use App\AtencionProfesionalesLaboratorio;
use App\Pacientes;
use App\Paquetes;
use App\PaquetesServ;
use App\Profesionales;
use App\Servicios;
use App\Analisis;
use App\Debitos;
use App\Empresas;
use App\Locales;
use App\Recibos;
use Carbon\Carbon;
use Elibyy\TCPDF\Facades\TCPDF;
use PDF;

class ReportesController extends Controller
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
                    ->first();                    
                    //->get();
                    
                    $usuarioEmp = $searchUsuarioID->id_empresa;
                    $usuarioSuc = $searchUsuarioID->id_sucursal;
                    
     $f1 = date('YYYY-m-d');
     $f2 = date('YYYY-m-d');
 
     $f1 = $request->fecha;
     $f2 = $request->fecha2;
     $servicios = $request->servicios;
     $analisis = $request->analisis;
     $pacientes = $request->pacientes;



        $reporte = DB::table('atencion_profesionales_servicios as a')
        ->select('a.id', 'a.id_atencion', 'a.id_servicio', 'a.pagado', 'a.porcentaje', 'a.recibo', 'a.created_at as fecha','a.id_profesional', 'b.costo','b.id_paciente','b.costoa', 'f.name as nombres', 'f.apellidos', 'b.origen', 'p.nombres as pnombres', 'p.apellidos as papellidos','c.detalle as detalle','c.precio')
        ->join('profesionales as f','f.id','a.id_profesional')
        ->join('atencion_detalles as b','a.id_atencion','b.id_atencion')
        ->join('pacientes as p','p.id','b.id_paciente')
      //  ->join('atencion_servicios as s', 'a.id_atencion', 's.id_atencion')
        ->join('servicios as c','c.id','a.id_servicio')
       // ->where('a.id_profesional','<>',999)
       // ->where('a.id_servicio','=',$request->servicios )
        ->where('a.id_empresa','=', $usuarioEmp)
        ->where('a.id_sucursal','=', $usuarioSuc)
        ->whereBetween('a.created_at', [$f1, $f2])
        ->get();
 

/*
    } else if(! is_null($request->analisis))  {

          $reporte = DB::table('atencion_profesionales_laboratorios as a')
        ->select('a.id', 'a.id_atencion', 'a.id_laboratorio as id_servicio', 'a.pagado', 'a.porcentaje',
        'a.recibo', 'a.created_at as fecha','a.id_profesional', 'b.costo','b.id_paciente','b.costoa', 'f.name as nombres',
        'f.apellidos', 'b.origen', 'p.nombres as pnombres', 'p.apellidos as papellidos','c.name as detalle','c.preciopublico as precio')
        ->join('profesionales as f','f.id','a.id_profesional')
        ->join('atencion_detalles as b','a.id_atencion','b.id_atencion')
        ->join('pacientes as p','p.id','b.id_paciente')
        ->join('atencion_laboratorios as s', 'a.id_atencion', 's.id_atencion')
        ->join('analises as c','c.id','a.id_laboratorio')
        ->where('a.id_profesional','<>',999)
        ->where('a.id_laboratorio','=',$request->analisis)
        ->where('a.id_empresa','=', $usuarioEmp)
        ->where('a.id_sucursal','=', $usuarioSuc)
        ->whereBetween('a.created_at', [$f1, $f2])
        ->orderby('a.id_atencion','asc')
        ->get();


    } /*else {

       $comisiones_lab = DB::table('atencion_profesionales_laboratorios as a')
        ->select('a.id', 'a.id_atencion', 'a.id_laboratorio as id_servicio', 'a.pagado', 'a.porcentaje',
        'a.recibo', 'a.created_at as fecha','a.pagar', 'b.costo', 'f.name as nombres',
        'f.apellidos', 's.origen', 'p.nombres as pnombres', 'p.apellidos as papellidos','c.name as detalle','c.preciopublico as precio','a.id_profesional')
        ->join('profesionales as f','f.id','a.id_profesional')
        ->join('atencion_detalles as b','a.id_atencion','b.id_atencion')
        ->join('pacientes as p','p.id','b.id_paciente')
        ->join('atencion_laboratorios as s', 'a.id_atencion', 's.id_atencion')
        ->join('analises as c','c.id','a.id_laboratorio')
        ->where('a.id_profesional','<>',999)
        ->where('b.id_paciente','=',$request->pacientes)
        ->where('a.id_empresa','=', $usuarioEmp)
        ->where('a.id_sucursal','=', $usuarioSuc)
        ->whereBetween('a.created_at', [$f1, $f2]);

        $reporte = DB::table('atencion_profesionales_servicios as a')
        ->select('a.id', 'a.id_atencion', 'a.id_servicio', 'a.pagado', 'a.porcentaje', 'a.recibo', 'a.created_at as fecha','a.pagar', 'b.costo', 'f.name as nombres', 'f.apellidos', 's.origen', 'p.nombres as pnombres', 'p.apellidos as papellidos','c.detalle as detalle','c.precio','a.id_profesional')
        ->join('profesionales as f','f.id','a.id_profesional')
        ->join('atencion_detalles as b','a.id_atencion','b.id_atencion')
        ->join('pacientes as p','p.id','b.id_paciente')
        ->join('atencion_servicios as s', 'a.id_atencion', 's.id_atencion')
        ->join('servicios as c','c.id','a.id_servicio')
        ->where('a.id_profesional','<>',999)
        ->where('b.id_paciente','=',$request->pacientes)
        ->where('a.id_empresa','=', $usuarioEmp)
        ->where('a.id_sucursal','=', $usuarioSuc)
        ->whereBetween('a.created_at', [$f1, $f2])
        ->union($comisiones_lab)
        ->get();

    }*/


        $servicios = new Servicios();
        $analisis = new Analisis();
        $paquete = new Paquetes();
        $paquetes = new PaquetesServ();
        $atenciondetalle = new AtencionDetalle();


 

      // return view('reportes.filtroreport1', compact('reporte'));
    }



     public function filtrogeneral(Request $request)

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
        $servicios = $request->servicios;
        $analisis = $request->analisis;
        $pacientes = $request->pacientes;

     if(! is_null($request->analisis))  {
       $reporte = DB::table('atencion_profesionales_laboratorios as a')
        ->select('a.id', 'a.id_atencion', 'a.id_laboratorio as id_servicio', 'a.pagado', 'a.porcentaje',
        'a.recibo', 'a.created_at as fecha','a.id_profesional','a.pagar', 'b.costo','b.id_paciente','b.costoa', 'f.name as nombres',
        'f.apellidos', 'b.origen', 'p.nombres as pnombres', 'p.apellidos as papellidos','c.name as detalle','c.preciopublico as precio')
        ->join('profesionales as f','f.id','a.id_profesional')
        ->join('atencion_detalles as b','a.id_atencion','b.id_atencion')
        ->join('pacientes as p','p.id','b.id_paciente')
        ->join('atencion_laboratorios as s', 'a.id_atencion', 's.id_atencion')
        ->join('analises as c','c.id','a.id_laboratorio')
        ->where('a.id_profesional','<>',999)
        ->where('a.id_laboratorio','=',$request->analisis)
        ->where('a.id_empresa','=', $usuarioEmp)
        ->where('a.id_sucursal','=', $usuarioSuc)
        ->whereBetween('a.created_at', [$f1, $f2])
        ->orderby('a.id_atencion','asc')
        ->get();

      } else if (! is_null($request->servicios))  {
        $reporte = DB::table('atencion_profesionales_servicios as a')
        ->select('a.id', 'a.id_atencion', 'a.id_servicio as id_servicio', 'a.pagado', 'a.porcentaje',
        'a.recibo', 'a.created_at as fecha','a.id_profesional','a.pagar', 'b.costo','b.id_paciente','b.costoa', 'f.name as nombres',
        'f.apellidos', 'b.origen', 'p.nombres as pnombres', 'p.apellidos as papellidos','c.detalle as detalle','c.precio')
        ->join('profesionales as f','f.id','a.id_profesional')
        ->join('atencion_detalles as b','a.id_atencion','b.id_atencion')
        ->join('pacientes as p','p.id','b.id_paciente')
        ->join('atencion_laboratorios as s', 'a.id_atencion', 's.id_atencion')
        ->join('servicios as c','c.id','a.id_servicio')
        ->where('a.id_profesional','<>',999)
        ->where('a.id_servicio','=',$request->servicios)
        ->where('a.id_empresa','=', $usuarioEmp)
        ->where('a.id_sucursal','=', $usuarioSuc)
        ->whereBetween('a.created_at', [$f1, $f2])
        ->orderby('a.id_atencion','asc')
        ->get();


      } else if (! is_null($request->pacientes)){

       $comisiones_lab = DB::table('atencion_profesionales_laboratorios as a')
        ->select('a.id', 'a.id_atencion', 'a.id_laboratorio as id_servicio', 'a.pagado', 'a.porcentaje',
        'a.recibo', 'a.created_at as fecha','a.pagar', 'b.costo','b.id_paciente','b.costoa', 'f.name as nombres',
        'f.apellidos', 's.origen', 'p.nombres as pnombres', 'p.apellidos as papellidos','c.name as detalle','c.preciopublico as precio','a.id_profesional')
        ->join('profesionales as f','f.id','a.id_profesional')
        ->join('atencion_detalles as b','a.id_atencion','b.id_atencion')
        ->join('pacientes as p','p.id','b.id_paciente')
        ->join('atencion_laboratorios as s', 'a.id_atencion', 's.id_atencion')
        ->join('analises as c','c.id','a.id_laboratorio')
        ->where('a.id_profesional','<>',999)
        ->where('b.id_paciente','=',$request->pacientes)
        ->where('a.id_empresa','=', $usuarioEmp)
        ->where('a.id_sucursal','=', $usuarioSuc)
        ->whereBetween('a.created_at', [$f1, $f2]);

        $reporte = DB::table('atencion_profesionales_servicios as a')
        ->select('a.id', 'a.id_atencion', 'a.id_servicio', 'a.pagado', 'a.porcentaje', 'a.recibo', 'a.created_at as fecha','a.pagar', 'b.costo','b.id_paciente','b.costoa', 'f.name as nombres', 'f.apellidos', 's.origen', 'p.nombres as pnombres', 'p.apellidos as papellidos','c.detalle as detalle','c.precio','a.id_profesional')
        ->join('profesionales as f','f.id','a.id_profesional')
        ->join('atencion_detalles as b','a.id_atencion','b.id_atencion')
        ->join('pacientes as p','p.id','b.id_paciente')
        ->join('atencion_servicios as s', 'a.id_atencion', 's.id_atencion')
        ->join('servicios as c','c.id','a.id_servicio')
        ->where('a.id_profesional','<>',999)
        ->where('b.id_paciente','=',$request->pacientes)
        ->where('a.id_empresa','=', $usuarioEmp)
        ->where('a.id_sucursal','=', $usuarioSuc)
        ->whereBetween('a.created_at', [$f1, $f2])
        ->union($comisiones_lab)
        ->get();



      } else {
          $reporte = DB::table('atencion_profesionales_servicios as a')
        ->select('a.id', 'a.id_atencion', 'a.id_servicio as id_servicio', 'a.pagado', 'a.porcentaje',
        'a.recibo', 'a.created_at as fecha','a.id_profesional','a.pagar', 'b.costo','b.id_paciente','b.costoa', 'f.name as nombres',
        'f.apellidos', 'b.origen', 'p.nombres as pnombres', 'p.apellidos as papellidos','c.detalle as detalle','c.precio')
        ->join('profesionales as f','f.id','a.id_profesional')
        ->join('atencion_detalles as b','a.id_atencion','b.id_atencion')
        ->join('pacientes as p','p.id','b.id_paciente')
        ->join('atencion_laboratorios as s', 'a.id_atencion', 's.id_atencion')
        ->join('servicios as c','c.id','a.id_servicio')
        ->where('a.id_profesional','<>',999)
        //->where('a.id_laboratorio','=',$request->analisis)
        ->where('a.id_empresa','=', $usuarioEmp)
        ->where('a.id_sucursal','=', $usuarioSuc)
        //->whereBetween('a.created_at', [$f1, $f2])
        ->orderby('a.id_atencion','asc')
        ->get();


      }

       $servicioss = new Servicios();
        $analisiss = new Analisis();
        $paquetes = new Paquetes();
        $paquetess = new PaquetesServ();
        $atenciondetalles = new AtencionDetalle();

       
       $servicios = DB::table('servicios')
        ->select('*')
        ->where('id_empresa','=', $usuarioEmp)
        ->where('id_sucursal','=', $usuarioSuc)
        ->get()->pluck('detalle','detalle');

       $analisis = DB::table('analises')
        ->select('*')
        ->where('id_empresa','=', $usuarioEmp)
        ->where('id_sucursal','=', $usuarioSuc)
        ->get()->pluck('name','name');

        $pacientes = DB::table('pacientes')
        ->select('*')
        ->where('id_empresa','=', $usuarioEmp)
        ->where('id_sucursal','=', $usuarioSuc)
        ->get()->pluck('nombres','nombres');


        return view('reportes.filtroreport1', compact('reporte','servicios','analisis','pacientes','servicioss','analisiss','paquetes','paquetess','atenciondetalles'));
    }

    public function pacientes(){

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

    

       $pacientes   = Pacientes::select(
             DB::raw("CONCAT(nombres,' ',apellidos) AS nombres"),'id')                  
                             ->where('id_empresa',$usuarioEmp)
                             ->where('id_sucursal',$usuarioSuc)
                             ->get()->pluck('nombres','id');

      return view('reportes.pacientes', compact('pacientes'));


    }

     public function servicios(){

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

      $servicios = DB::table('servicios')
      ->select('*')
      ->where('id_empresa','=', $usuarioEmp)
      ->where('id_sucursal','=', $usuarioSuc)
      ->get()->pluck('detalle','id');

      return view('reportes.servicios', compact('servicios'));


    }

      public function analisis(){


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

      $analisis = DB::table('analises')
      ->select('*')
      ->where('id_empresa','=', $usuarioEmp)
      ->where('id_sucursal','=', $usuarioSuc)
      ->get()->pluck('name','id');

      return view('reportes.analisis', compact('analisis'));


    }

    public function reportegeneral()
    {
        if (! Gate::allows('users_manage')) {
            return abort(401);
        }
      /*
        "desde" => "2018-08-16"
        "hasta" => "2018-08-16"
        "tipo_ingreso" => "EF"
        "origen" => "INGRESO DE ATENCIONES"
       */
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
$datos_usuario=" id_empresa=".$usuarioEmp." and id_sucursal=".$usuarioSuc." ";
       $desde = $_POST['desde'] !='' ? " and created_at >= '". $_POST['desde']."'"    : null ;
    $hasta = $_POST['hasta'] !='' ? " and created_at <= '". $_POST['hasta']."'"    : null ;
     $tipo_ingreso = $_POST['tipo_ingreso'] !='' ? " and tipo_ingreso = '".$_POST['tipo_ingreso']."' "    : null ;
    $origen = $_POST['origen'] !='' ? " and origen = '".$_POST['origen']."' "    : null;
    $sql=$datos_usuario.$desde.$hasta.$tipo_ingreso.$origen;
   // dd( $sql);
      $model=\DB::select("SELECT * from creditos
             where  ".$sql);
     /* $con=0;
      foreach ($model as $key => $value) {
        $con++;
          echo "Id".$value->id.'Recorrido:'.$con.'<br>';
      }
      exit();*/
$data=[
    'model'=>$model

];
      

$view = \View::make("reportes.report-1",$data);
$pdf = \App::make('dompdf.wrapper');
       //$pdf->loadHTML($view)->setPaper('letter', 'landscape');

$pdf->loadHTML($view)->setPaper('letter', 'portrait');$pdf->output();


       
        return $pdf->download('historiapaciente');

     // return view("reportes.report-1",$data);
    }
     

      


}
