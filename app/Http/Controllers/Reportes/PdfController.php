<?php

namespace App\Http\Controllers\Reportes;

use App\Atencion;
use App\AtencionDetalle;
use App\Empresas;
use App\Locales;
use App\Servicios;
use App\Personal;
use App\Pacientes;
use App\Profesionales;
use App\Analisis;
use App\AtencionLaboratorio;
use App\Creditos;
use Carbon\Carbon;
use DB;
use Illuminate\Support\Facades\Auth;
use Silber\Bouncer\Database\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Movimientos\StoreAtencionRequest;
use App\Http\Requests\Movimientos\UpdateAtencionRequest;
use Elibyy\TCPDF\Facades\TCPDF;
use PDF;


class PdfController extends Controller

{

 public function indexfiltro()
    {
        if (! Gate::allows('users_manage')) {
            return abort(401);
        }


        return view('reportes.index');
    }
     public function index()
    {
        if (! Gate::allows('users_manage')) {
            return abort(401);
        }


        return view('reportes.index');
    }
    
      public function atenciondiariaSUMATOTAL(){

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


          $creditos = DB::table('creditos as a')
               ->select(DB::raw('SUM(a.monto) as total_monto','id_empresa','a.id_sucursal','a.origen','a.id','a.created_at as fecha'))
               ->where('a.id_empresa','=', $usuarioEmp)
               ->where('a.id_sucursal','=', $usuarioSuc)
               ->whereDate('a.created_at', '=', Carbon::now()->format('Y-m-d'))
               ->havingRaw('SUM(a.monto) > ?', [0])
               ->get();


          if(!is_null($creditos)){
            return $creditos;
         }else{
            return false;
         }  

          } 

          public function atenciondiariaSERVICIOS(){

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

      

          $creditos = DB::table('creditos as a')
               ->select(DB::raw('COUNT(a.origen) as total_servicios','id_empresa','a.id_sucursal','a.origen','a.id','a.created_at'))
               ->where('a.id_empresa','=', $usuarioEmp)
               ->where('a.id_sucursal','=', $usuarioSuc)
               ->where('a.origen','=','INGRESO DE ATENCIONES')
               ->whereDate('a.created_at', '=', Carbon::now()->format('Y-m-d'))
               ->get();


          if(!is_null($creditos)){
            return $creditos;
         }else{
            return false;
         }  
          }  


           public function atenciondiariaSERVICIOSMONTO(){

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


                $creditos = DB::table('creditos as a')
               ->select(DB::raw('SUM(a.monto) as total_monto_servicios','id_empresa','a.id_sucursal','a.origen','a.id','a.created_at'))
               ->where('a.id_empresa','=', $usuarioEmp)
               ->where('a.id_sucursal','=', $usuarioSuc)
               ->where('a.origen','=','INGRESO DE ATENCIONES')
               ->whereDate('a.created_at', '=', Carbon::now()->format('Y-m-d'))
               ->havingRaw('SUM(a.monto) > ?', [0])
               ->get();





          if(!is_null($creditos)){
            return $creditos;
         }else{
            return false;
         }  

      }

      public function atenciondiariaOTROSINGRESOS(){

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

       

          $creditos = DB::table('creditos as a')
               ->select(DB::raw('COUNT(a.origen) as total_otrosingresos','id_empresa','a.id_sucursal','a.origen','a.id','a.created_at'))
               //->select('SUM(a.monto) as total_monto','a.id_empresa','a.id_sucursal','a.created_at')
               ->where('a.id_empresa','=', $usuarioEmp)
               ->where('a.id_sucursal','=', $usuarioSuc)
               ->where('a.origen','=','OTROS INGRESOS')
               ->whereDate('a.created_at', '=', Carbon::now()->format('Y-m-d'))
               ->get();


          if(!is_null($creditos)){
            return $creditos;
         }else{
            return false;
         }  
          }  

    public function atenciondiariaOTROSINGRESOSMONTO(){

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


              $creditos = DB::table('creditos as a')
               ->select(DB::raw('SUM(a.monto) as total_monto_otrosingresos','id_empresa','a.id_sucursal','a.origen','a.id','a.created_at'))
               ->where('a.id_empresa','=', $usuarioEmp)
               ->where('a.id_sucursal','=', $usuarioSuc)
               ->where('a.origen','=','OTROS INGRESOS')
               ->whereDate('a.created_at', '=', Carbon::now()->format('Y-m-d'))
               ->havingRaw('SUM(a.monto) > ?', [0])
               ->get();



          if(!is_null($creditos)){
            return $creditos;
         }else{
            return false;
         }  

      }

       public function atenciondiariaCUENTASPORCOBRAR(){

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

       

          $creditos = DB::table('creditos as a')
               ->select(DB::raw('COUNT(a.origen) as total_cxc','id_empresa','a.id_sucursal','a.origen','a.id','a.created_at','a.causa'))
               //->select('SUM(a.monto) as total_monto','a.id_empresa','a.id_sucursal','a.created_at')
               ->where('a.id_empresa','=', $usuarioEmp)
               ->where('a.id_sucursal','=', $usuarioSuc)
               ->where('a.causa','=','CC')
               ->whereDate('a.created_at', '=', Carbon::now()->format('Y-m-d'))
               ->get();


          if(!is_null($creditos)){
            return $creditos;
         }else{
            return false;
         }  
          }  

         public function atenciondiariaCUENTASPORCOBRARMONTO(){

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


              $creditos = DB::table('creditos as a')
               ->select(DB::raw('SUM(a.monto) as total_monto_cxc','id_empresa','a.id_sucursal','a.origen','a.id','a.created_at','a.causa'))
               ->where('a.id_empresa','=', $usuarioEmp)
               ->where('a.id_sucursal','=', $usuarioSuc)
               ->where('a.causa','=','CC')
               ->whereDate('a.created_at', '=', Carbon::now()->format('Y-m-d'))
               ->havingRaw('SUM(a.monto) > ?', [0])
               ->get();



          if(!is_null($creditos)){
            return $creditos;
         }else{
            return false;
         }  

      }

         public function atenciondiariaTOTALEGRESOS(){

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

      

          $debitos = DB::table('debitos as a')
               ->select(DB::raw('SUM(a.monto) as total_egresos','id_empresa','a.id_sucursal','a.origen','a.id','a.created_at','a.descripcion as descripcion'))
               ->where('a.id_empresa','=', $usuarioEmp)
               ->where('a.id_sucursal','=', $usuarioSuc)
             //  ->where('a.origen','=','INGRESO DE ATENCIONES')
               ->whereDate('a.created_at', '=', Carbon::now()->format('Y-m-d'))
               ->get();


          if(!is_null($debitos)){
            return $debitos;
         }else{
            return false;
         }  
          }  

          public function atenciondiariaDETALLEEGRESOS(){

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

      

          $debitos = DB::table('debitos as a')
               ->select('a.id_empresa','a.id_sucursal','a.origen','a.id','a.created_at','a.descripcion','a.monto')
               ->where('a.id_empresa','=', $usuarioEmp)
               ->where('a.id_sucursal','=', $usuarioSuc)
             //  ->where('a.origen','=','INGRESO DE ATENCIONES')
               ->whereDate('a.created_at', '=', Carbon::now()->format('Y-m-d'))
               ->get();


          if(!is_null($debitos)){
            return $debitos;
         }else{
            return false;
         }  
          }  

       
       
         public function ingresosEF(){

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

      

          $creditos = DB::table('creditos as a')
               ->select(DB::raw('SUM(a.monto) as total_monto_ef','id_empresa','a.id_sucursal','a.origen','a.id','a.created_at','a.tipo_ingreso'))
               ->where('a.id_empresa','=', $usuarioEmp)
               ->where('a.id_sucursal','=', $usuarioSuc)
               ->where('a.tipo_ingreso','=','EF')
             //  ->where('a.origen','=','INGRESO DE ATENCIONES')
               ->whereDate('a.created_at', '=', Carbon::now()->format('Y-m-d'))
               ->get();


          if(!is_null($creditos)){
            return $creditos;
         }else{
            return false;
         }  
          }  

        public function ingresosTJ(){

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

      

          $creditos = DB::table('creditos as a')
               ->select(DB::raw('SUM(a.monto) as total_monto_tj','id_empresa','a.id_sucursal','a.origen','a.id','a.created_at','a.tipo_ingreso'))
               ->where('a.id_empresa','=', $usuarioEmp)
               ->where('a.id_sucursal','=', $usuarioSuc)
               ->where('a.tipo_ingreso','=','TJ')
             //  ->where('a.origen','=','INGRESO DE ATENCIONES')
               ->whereDate('a.created_at', '=', Carbon::now()->format('Y-m-d'))
               ->get();


          if(!is_null($creditos)){
            return $creditos;
         }else{
            return false;
         }  
          }  
      
        public function empresaSucursal(){

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

      

          $empresaSucursal = DB::table('empresas as a')
               ->select('a.id','a.nombre as empresa','b.id','b.nombres as sucursal')
               ->join('locales as b','a.id','b.id_empresa')
               ->where('a.id','=', $usuarioEmp)
               ->where('b.id','=', $usuarioSuc)
               ->get();


          if(!is_null($empresaSucursal)){
            return $empresaSucursal;
         }else{
            return false;
         }  
          }  

       public function listado_atenciondiaria_ver() 
    {
       
       $creditosSUMATOTALINGRESOS =PdfController::atenciondiariaSUMATOTAL();
       $creditosSERVICIOS =PdfController::atenciondiariaSERVICIOS();
       $creditosSERVICIOSMONTO =PdfController::atenciondiariaSERVICIOSMONTO();
       $creditosOTROSINGRESOS =PdfController::atenciondiariaOTROSINGRESOS();
       $creditosOTROSINGRESOMONTO =PdfController::atenciondiariaOTROSINGRESOSMONTO();
       $creditosCXC =PdfController::atenciondiariaCUENTASPORCOBRAR();
       $creditosCXCMONTO =PdfController::atenciondiariaCUENTASPORCOBRARMONTO();
       $debitosSUMATOTAL =PdfController::atenciondiariaTOTALEGRESOS();
       $debitosDETALLE =PdfController::atenciondiariaDETALLEEGRESOS();
       $creditosEF =PdfController::ingresosEF();
       $creditosTJ =PdfController::ingresosTJ();
       $empresaSucursal =PdfController::empresaSucursal();

       $view = \View::make('reportes.listado_atenciondiaria_ver')->with('creditos', $creditosSUMATOTALINGRESOS)->with('servicios', $creditosSERVICIOS)->with('serviciosmonto', $creditosSERVICIOSMONTO)->with('otrosingresos', $creditosOTROSINGRESOS)->with('otrosingresosmonto', $creditosOTROSINGRESOMONTO)->with('debitostotal', $debitosSUMATOTAL)->with('debitosdetalle', $debitosDETALLE)->with('ingresosef', $creditosEF)->with('ingresostj', $creditosTJ)->with('empresasucursal', $empresaSucursal)->with('ingresoscxc', $creditosCXC)->with('ingresoscxcmonto', $creditosCXCMONTO);
       $pdf = \App::make('dompdf.wrapper');
       $pdf->loadHTML($view);
       
        return $pdf->stream('atenciondiaria');

    }


     public function verHistoriaPaciente($id){
       

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


        $pacientes = DB::table('pacientes as a')
        ->select('a.id','a.nombres','a.apellidos','a.dni','a.provincia','a.distrito','a.direccion','a.gradoinstruccion','a.telefono','a.ocupacion','a.edocivil','a.fechanac','a.created_at','b.historia')
        ->join('historias_clinicas as b','a.id','b.id_paciente')
        ->where('a.id_empresa','=',$usuarioEmp)
        ->where('a.id_sucursal','=',$usuarioSuc)
        ->where('a.id','=',$id)
        ->orderby('a.created_at','desc')
        ->get();


        if(!is_null($pacientes)){
            return $pacientes;
         }else{
            return false;
         }  

     }

       public function historia_pacientes_ver($id) 
    {
       
       $pacientes =PdfController::verHistoriaPaciente($id);

       $view = \View::make('reportes.historia_pacientes_ver')->with('pacientes', $pacientes);
       $pdf = \App::make('dompdf.wrapper');
       $pdf->loadHTML($view);
       
        return $pdf->stream('historiapaciente');

    }




}
