<?php

namespace App\Http\Controllers\Reportes;

use App\Atencion;
use App\AtencionDetalle;
use App\AtencionLaboratorio;
use App\AtencionProfesionalesServicio;
use App\AtencionProfesionalesLaboratorio;
use App\Empresas;
use App\Locales;
use App\Servicios;
use App\Personal;
use App\Pacientes;
use App\Profesionales;
use App\Analisis;
use App\Creditos;
use Carbon\Carbon;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
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

      public function totalDiario(){

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
      ->select(DB::raw('SUM(a.monto) as creditos'))
      ->where('a.id_empresa','=', $usuarioEmp)
      ->where('a.id_sucursal','=', $usuarioSuc)
              // ->where('a.tipo_ingreso','=','EF')
             //  ->where('a.origen','=','INGRESO DE ATENCIONES')
      ->whereDate('a.created_at', '=', Carbon::now()->format('Y-m-d'))
      ->first();

      $debitos =DB::table('debitos as a')
      ->select(DB::raw('SUM(a.monto) as debitos'))
      ->where('a.id_empresa','=', $usuarioEmp)
      ->where('a.id_sucursal','=', $usuarioSuc)
              // ->where('a.tipo_ingreso','=','EF')
             //  ->where('a.origen','=','INGRESO DE ATENCIONES')
      ->whereDate('a.created_at', '=', Carbon::now()->format('Y-m-d'))
      ->first();
      
      $totalDiario =($creditos - $debitos);
    
      return Response::json($totalDiario);


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



       public function verReciboProfesional($id){
       

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


         $reciboprofesional = DB::table('atencion_profesionales_servicios as a')
        ->select('a.id','a.id_servicio','a.id_atencion','a.id_profesional','a.id_servicio','a.created_at as fecha','a.pagado','a.id_sucursal','a.id_empresa','b.costo','b.id_paciente','d.detalle','d.porcentaje','e.nombres','e.apellidos','f.name as profnombre','f.apellidos as profapellido','f.centro')
        ->join('atencion_detalles as b','a.id_atencion','b.id_atencion')
        ->join('servicios as d','d.id','a.id_servicio')
        ->join('pacientes as e','e.id','b.id_paciente')
        ->join('profesionales as f','f.id','a.id_profesional')
        ->where('a.pagado','=',1)
        ->where('a.id','=',$id)
        ->where('a.id_empresa','=', $usuarioEmp)
        ->where('a.id_sucursal','=', $usuarioSuc)
        ->orderby('a.created_at','desc')
        ->get();


        if(!is_null($reciboprofesional)){
            return $reciboprofesional;
         }else{
            return false;
         }  

     }


       public function recibo_profesionales_ver($id) 
    {
       
       $reciboprofesional =PdfController::verReciboProfesional($id);

       $view = \View::make('reportes.recibo_profesionales_ver')->with('reciboprofesional', $reciboprofesional);
       $pdf = \App::make('dompdf.wrapper');
       $pdf->loadHTML($view);
       
        return $pdf->stream('recibo_profesionales_ver');

    }

    public function verResultado($id){
       

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


        
                $servicios = DB::table('atencion_servicios as a')
                ->select('a.id','a.id_atencion','a.id_servicio','a.pagado','a.id_empresa','a.id_sucursal','a.created_at','d.detalle as detalleservicio','e.id_paciente','f.nombres','f.apellidos','a.status_redactar_resultados','h.descripcion as resultado')
                ->join('empresas as b','a.id_empresa','b.id')
                ->join('locales as c','a.id_sucursal','c.id')
                ->join('servicios as d','a.id_servicio','d.id')
                ->join('atencion_detalles as e','a.id_atencion','e.id_atencion')
                ->join('pacientes as f','f.id','e.id_paciente')
                ->join('redactar_resultados as h','a.id','h.id_atencion_servicio')
                ->where('a.status_redactar_resultados','=',1)
                ->where('a.id_empresa','=', $usuarioEmp)
                ->where('a.id_sucursal','=', $usuarioSuc)
                ->where('a.id','=', $id)
                    //->whereDate('a.created_at', '=', Carbon::now()->format('Y-m-d'))
                ->orderby('a.created_at','desc')
                ->get();


        if(!is_null($servicios)){
            return $servicios;
         }else{
            return false;
         }  

     }




       public function resultados_ver($id) 
    {
       
     $servicios =PdfController::verResultado($id);

     $view = \View::make('reportes.resultados_ver')->with('servicios', $servicios);
     $pdf = \App::make('dompdf.wrapper');
     $pdf->loadHTML($view);
     
       
        return $pdf->stream('resultados_ver');

    }




}
