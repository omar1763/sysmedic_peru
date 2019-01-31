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
use App\Paquetes;
use App\PaquetesServ;
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
    
      public function atenciondiariaSUMATOTAL(Request $request){

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

        if(! is_null($request->fecha)) {
        $f1 = $request->fecha;
            
          $creditos = DB::table('creditos as a')
               ->select(DB::raw('SUM(a.monto) as total_monto','id_empresa','a.id_sucursal','a.origen','a.id','a.created_at as fecha'))
               ->where('a.id_empresa','=', $usuarioEmp)
               ->where('a.id_sucursal','=', $usuarioSuc)
               ->where('a.created_at','=', $f1)
               //->whereDate('a.created_at', '=', Carbon::now()->format('Y-m-d'))
               ->havingRaw('SUM(a.monto) > ?', [0])
               ->get();
        } else {

        $creditos = DB::table('creditos as a')
               ->select(DB::raw('SUM(a.monto) as total_monto','id_empresa','a.id_sucursal','a.origen','a.id','a.created_at as fecha'))
               ->where('a.id_empresa','=', $usuarioEmp)
               ->where('a.id_sucursal','=', $usuarioSuc)
               ->whereDate('a.created_at', '=', Carbon::now()->format('Y-m-d'))
               ->havingRaw('SUM(a.monto) > ?', [0])
               ->get();


        }

          if(!is_null($creditos)){
            return $creditos;
         }else{
            return false;
         }  

          } 

          public function atenciondiariaSERVICIOS(Request $request){

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

        if(! is_null($request->fecha)) {
        $f1 = $request->fecha;

        $creditos = DB::table('creditos as a')
        ->select(DB::raw('COUNT(a.origen) as total_servicios','id_empresa','a.id_sucursal','a.origen','a.id','a.created_at'))
        ->where('a.id_empresa','=', $usuarioEmp)
        ->where('a.id_sucursal','=', $usuarioSuc)
        ->where('a.origen','=','INGRESO DE ATENCIONES')
        ->where('a.created_at','=', $f1)
               //->whereDate('a.created_at', '=', Carbon::now()->format('Y-m-d'))
        ->get();

      } else {

        $creditos = DB::table('creditos as a')
        ->select(DB::raw('COUNT(a.origen) as total_servicios','id_empresa','a.id_sucursal','a.origen','a.id','a.created_at'))
        ->where('a.id_empresa','=', $usuarioEmp)
        ->where('a.id_sucursal','=', $usuarioSuc)
        ->where('a.origen','=','INGRESO DE ATENCIONES')
        ->whereDate('a.created_at', '=', Carbon::now()->format('Y-m-d'))
        ->get();


      }

          if(!is_null($creditos)){
            return $creditos;
         }else{
            return false;
         }  
          }  


          public function atenciondiariaSERVICIOSMONTO(Request $request){

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

            if(! is_null($request->fecha)) {
               $f1 = $request->fecha;
           


              $creditos = DB::table('creditos as a')
              ->select(DB::raw('SUM(a.monto) as total_monto_servicios','id_empresa','a.id_sucursal','a.origen','a.id','a.created_at'))
              ->where('a.id_empresa','=', $usuarioEmp)
              ->where('a.id_sucursal','=', $usuarioSuc)
              ->where('a.origen','=','INGRESO DE ATENCIONES')
              ->where('a.created_at','=', $f1)
               //->whereDate('a.created_at', '=', Carbon::now()->format('Y-m-d'))
              ->havingRaw('SUM(a.monto) > ?', [0])
              ->get();
            } else {

              $creditos = DB::table('creditos as a')
              ->select(DB::raw('SUM(a.monto) as total_monto_servicios','id_empresa','a.id_sucursal','a.origen','a.id','a.created_at'))
              ->where('a.id_empresa','=', $usuarioEmp)
              ->where('a.id_sucursal','=', $usuarioSuc)
              ->where('a.origen','=','INGRESO DE ATENCIONES')
              ->whereDate('a.created_at', '=', Carbon::now()->format('Y-m-d'))
              ->havingRaw('SUM(a.monto) > ?', [0])
              ->get();


            }




            if(!is_null($creditos)){
              return $creditos;
            }else{
              return false;
            }  

          }


          public function atenciondiariaOTROSINGRESOS(Request $request){

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

            if(! is_null($request->fecha)) {
               $f1 = $request->fecha;
            

              $creditos = DB::table('creditos as a')
              ->select(DB::raw('COUNT(a.origen) as total_otrosingresos','id_empresa','a.id_sucursal','a.origen','a.id','a.created_at'))
               //->select('SUM(a.monto) as total_monto','a.id_empresa','a.id_sucursal','a.created_at')
              ->where('a.id_empresa','=', $usuarioEmp)
              ->where('a.id_sucursal','=', $usuarioSuc)
              ->where('a.origen','=','OTROS INGRESOS')
               ->where('a.created_at','=', $f1)
                //->whereDate('a.created_at', '=', Carbon::now()->format('Y-m-d'))
              ->get();

            } else {
              $creditos = DB::table('creditos as a')
              ->select(DB::raw('COUNT(a.origen) as total_otrosingresos','id_empresa','a.id_sucursal','a.origen','a.id','a.created_at'))
               //->select('SUM(a.monto) as total_monto','a.id_empresa','a.id_sucursal','a.created_at')
              ->where('a.id_empresa','=', $usuarioEmp)
              ->where('a.id_sucursal','=', $usuarioSuc)
              ->where('a.origen','=','OTROS INGRESOS')
              ->whereDate('a.created_at', '=', Carbon::now()->format('Y-m-d'))
              ->get();


            }


            if(!is_null($creditos)){
              return $creditos;
            }else{
              return false;
            }  
          }  


          public function atenciondiariaOTROSINGRESOSMONTO(Request $request){

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

            if(! is_null($request->fecha)) {
               $f1 = $request->fecha;
        

              $creditos = DB::table('creditos as a')
              ->select(DB::raw('SUM(a.monto) as total_monto_otrosingresos','id_empresa','a.id_sucursal','a.origen','a.id','a.created_at'))
              ->where('a.id_empresa','=', $usuarioEmp)
              ->where('a.id_sucursal','=', $usuarioSuc)
              ->where('a.origen','=','OTROS INGRESOS')
              ->where('a.created_at','=', $f1)
               //->whereDate('a.created_at', '=', Carbon::now()->format('Y-m-d'))
              ->havingRaw('SUM(a.monto) > ?', [0])
              ->get();

            } else {

              $creditos = DB::table('creditos as a')
              ->select(DB::raw('SUM(a.monto) as total_monto_otrosingresos','id_empresa','a.id_sucursal','a.origen','a.id','a.created_at'))
              ->where('a.id_empresa','=', $usuarioEmp)
              ->where('a.id_sucursal','=', $usuarioSuc)
              ->where('a.origen','=','OTROS INGRESOS')
              ->whereDate('a.created_at', '=', Carbon::now()->format('Y-m-d'))
              ->havingRaw('SUM(a.monto) > ?', [0])
              ->get();


            }


            if(!is_null($creditos)){
              return $creditos;
            }else{
              return false;
            }  

          }


          public function atenciondiariaCUENTASPORCOBRAR(Request $request){

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

            if(! is_null($request->fecha)) {
               $f1 = $request->fecha;


              $creditos = DB::table('creditos as a')
              ->select(DB::raw('COUNT(a.origen) as total_cxc','id_empresa','a.id_sucursal','a.origen','a.id','a.created_at','a.causa'))
               //->select('SUM(a.monto) as total_monto','a.id_empresa','a.id_sucursal','a.created_at')
              ->where('a.id_empresa','=', $usuarioEmp)
              ->where('a.id_sucursal','=', $usuarioSuc)
              ->where('a.causa','=','CC')
              ->where('a.created_at','=', $f1)
               //->whereDate('a.created_at', '=', Carbon::now()->format('Y-m-d'))
              ->get();
            } else  {

             $creditos = DB::table('creditos as a')
             ->select(DB::raw('COUNT(a.origen) as total_cxc','id_empresa','a.id_sucursal','a.origen','a.id','a.created_at','a.causa'))
               //->select('SUM(a.monto) as total_monto','a.id_empresa','a.id_sucursal','a.created_at')
             ->where('a.id_empresa','=', $usuarioEmp)
             ->where('a.id_sucursal','=', $usuarioSuc)
             ->where('a.causa','=','CC')
             ->whereDate('a.created_at', '=', Carbon::now()->format('Y-m-d'))
             ->get();

           }

           if(!is_null($creditos)){
            return $creditos;
          }else{
            return false;
          }  
        }  


        public function atenciondiariaCUENTASPORCOBRARMONTO(Request $request){

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

          if(! is_null($request->fecha)) {
            $f1 = $request->fecha;


            $creditos = DB::table('creditos as a')
            ->select(DB::raw('SUM(a.monto) as total_monto_cxc','id_empresa','a.id_sucursal','a.origen','a.id','a.created_at','a.causa'))
            ->where('a.id_empresa','=', $usuarioEmp)
            ->where('a.id_sucursal','=', $usuarioSuc)
            ->where('a.causa','=','CC')
            ->where('a.created_at','=', $f1)
               //->whereDate('a.created_at', '=', Carbon::now()->format('Y-m-d'))
            ->havingRaw('SUM(a.monto) > ?', [0])
            ->get();

          } else {

           $creditos = DB::table('creditos as a')
           ->select(DB::raw('SUM(a.monto) as total_monto_cxc','id_empresa','a.id_sucursal','a.origen','a.id','a.created_at','a.causa'))
           ->where('a.id_empresa','=', $usuarioEmp)
           ->where('a.id_sucursal','=', $usuarioSuc)
           ->where('a.causa','=','CC')
           ->whereDate('a.created_at', '=', Carbon::now()->format('Y-m-d'))
           ->havingRaw('SUM(a.monto) > ?', [0])
           ->get();



         }



         if(!is_null($creditos)){
          return $creditos;
        }else{
          return false;
        }  

      }

      public function atenciondiariaTOTALEGRESOS(Request $request){

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

        $f1 = $request->fecha;

        if(! is_null($request->fecha)) {
           $f1 = $request->fecha;

          $debitos = DB::table('debitos as a')
          ->select(DB::raw('SUM(a.monto) as total_egresos','id_empresa','a.id_sucursal','a.origen','a.id','a.created_at','a.descripcion as descripcion'))
          ->where('a.id_empresa','=', $usuarioEmp)
          ->where('a.id_sucursal','=', $usuarioSuc)
          ->where('a.created_at','=', $f1)
             //  ->where('a.origen','=','INGRESO DE ATENCIONES')
              // ->whereDate('a.created_at', '=', Carbon::now()->format('Y-m-d'))
          ->get();
        } else {

          $debitos = DB::table('debitos as a')
          ->select(DB::raw('SUM(a.monto) as total_egresos','id_empresa','a.id_sucursal','a.origen','a.id','a.created_at','a.descripcion as descripcion'))
          ->where('a.id_empresa','=', $usuarioEmp)
          ->where('a.id_sucursal','=', $usuarioSuc)
             //  ->where('a.origen','=','INGRESO DE ATENCIONES')
          ->whereDate('a.created_at', '=', Carbon::now()->format('Y-m-d'))
          ->get();



        }

        if(!is_null($debitos)){
          return $debitos;
        }else{
          return false;
        }  
      }  






      public function atenciondiariaDETALLEEGRESOS(Request $request){

        $id_usuario = Auth::id();

        $searchUsuarioID = DB::table('users')
        ->select('*')
        ->where('id','=', $id_usuario)
        ->get();

        foreach ($searchUsuarioID as $usuario) {
          $usuarioEmp = $usuario->id_empresa;
          $usuarioSuc = $usuario->id_sucursal;
        }


        $f1 = date('YYYY-m-d');
   

        $f1 = $request->fecha;

        if(! is_null($request->fecha)) {
           $f1 = $request->fecha;

          $debitos = DB::table('debitos as a')
          ->select('a.id_empresa','a.id_sucursal','a.origen','a.id','a.created_at','a.descripcion','a.monto')
          ->where('a.id_empresa','=', $usuarioEmp)
          ->where('a.id_sucursal','=', $usuarioSuc)
          ->where('a.created_at','=', $f1)
             //  ->where('a.origen','=','INGRESO DE ATENCIONES')
               //->whereDate('a.created_at', '=', Carbon::now()->format('Y-m-d'))
          ->get();

        } else {

          $debitos = DB::table('debitos as a')
          ->select('a.id_empresa','a.id_sucursal','a.origen','a.id','a.created_at','a.descripcion','a.monto')
          ->where('a.id_empresa','=', $usuarioEmp)
          ->where('a.id_sucursal','=', $usuarioSuc)
             //  ->where('a.origen','=','INGRESO DE ATENCIONES')
          ->whereDate('a.created_at', '=', Carbon::now()->format('Y-m-d'))
          ->get();


        }


        if(!is_null($debitos)){
          return $debitos;
        }else{
          return false;
        }  
      }  


       
      public function ingresosEF(Request $request){

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

        if(! is_null($request->fecha)) {
           $f1 = $request->fecha;

          $creditos = DB::table('creditos as a')
          ->select(DB::raw('SUM(a.monto) as total_monto_ef','id_empresa','a.id_sucursal','a.origen','a.id','a.created_at','a.tipo_ingreso'))
          ->where('a.id_empresa','=', $usuarioEmp)
          ->where('a.id_sucursal','=', $usuarioSuc)
          ->where('a.tipo_ingreso','=','EF')
          ->where('a.created_at','=', $f1)
             //  ->where('a.origen','=','INGRESO DE ATENCIONES')
              // ->whereDate('a.created_at', '=', Carbon::now()->format('Y-m-d'))
          ->get();

        } else {

         $creditos = DB::table('creditos as a')
         ->select(DB::raw('SUM(a.monto) as total_monto_ef','id_empresa','a.id_sucursal','a.origen','a.id','a.created_at','a.tipo_ingreso'))
         ->where('a.id_empresa','=', $usuarioEmp)
         ->where('a.id_sucursal','=', $usuarioSuc)
         ->where('a.tipo_ingreso','=','EF')
             //  ->where('a.origen','=','INGRESO DE ATENCIONES')
         ->whereDate('a.created_at', '=', Carbon::now()->format('Y-m-d'))
         ->get();



       }


       if(!is_null($creditos)){
        return $creditos;
      }else{
        return false;
      }  
    }  

    public function ingresosTJ(Request $request){

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

      $f1 = $request->fecha;

      if(! is_null($request->fecha)) {
         $f1 = $request->fecha;

        $creditos = DB::table('creditos as a')
        ->select(DB::raw('SUM(a.monto) as total_monto_tj','id_empresa','a.id_sucursal','a.origen','a.id','a.created_at','a.tipo_ingreso'))
        ->where('a.id_empresa','=', $usuarioEmp)
        ->where('a.id_sucursal','=', $usuarioSuc)
        ->where('a.tipo_ingreso','=','TJ')
        ->where('a.created_at','=', $f1)
             //  ->where('a.origen','=','INGRESO DE ATENCIONES')
              // ->whereDate('a.created_at', '=', Carbon::now()->format('Y-m-d'))
        ->get();

      } else {

       $creditos = DB::table('creditos as a')
       ->select(DB::raw('SUM(a.monto) as total_monto_tj','id_empresa','a.id_sucursal','a.origen','a.id','a.created_at','a.tipo_ingreso'))
       ->where('a.id_empresa','=', $usuarioEmp)
       ->where('a.id_sucursal','=', $usuarioSuc)
       ->where('a.tipo_ingreso','=','TJ')
             //  ->where('a.origen','=','INGRESO DE ATENCIONES')
       ->whereDate('a.created_at', '=', Carbon::now()->format('Y-m-d'))
       ->get();

     }


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

    

       public function listado_atenciondiaria_ver(Request $request) 
    {
       $f1 = date('d-m-YYYY');
       $f1 = $request->fecha;
       
       $creditosSUMATOTALINGRESOS =PdfController::atenciondiariaSUMATOTAL($request);
       $creditosSERVICIOS =PdfController::atenciondiariaSERVICIOS($request);
       $creditosSERVICIOSMONTO =PdfController::atenciondiariaSERVICIOSMONTO($request);
       $creditosOTROSINGRESOS =PdfController::atenciondiariaOTROSINGRESOS($request);
       $creditosOTROSINGRESOMONTO =PdfController::atenciondiariaOTROSINGRESOSMONTO($request);
       $creditosCXC =PdfController::atenciondiariaCUENTASPORCOBRAR($request);
       $creditosCXCMONTO =PdfController::atenciondiariaCUENTASPORCOBRARMONTO($request);
       $debitosSUMATOTAL =PdfController::atenciondiariaTOTALEGRESOS($request);
       $debitosDETALLE =PdfController::atenciondiariaDETALLEEGRESOS($request);
       $creditosEF =PdfController::ingresosEF($request);
       $creditosTJ =PdfController::ingresosTJ($request);
       $empresaSucursal =PdfController::empresaSucursal();

       $view = \View::make('reportes.listado_atenciondiaria_ver')->with('creditos', $creditosSUMATOTALINGRESOS)->with('servicios', $creditosSERVICIOS)->with('serviciosmonto', $creditosSERVICIOSMONTO)->with('otrosingresos', $creditosOTROSINGRESOS)->with('otrosingresosmonto', $creditosOTROSINGRESOMONTO)->with('debitostotal', $debitosSUMATOTAL)->with('debitosdetalle', $debitosDETALLE)->with('ingresosef', $creditosEF)->with('ingresostj', $creditosTJ)->with('empresasucursal', $empresaSucursal)->with('ingresoscxc', $creditosCXC)->with('ingresoscxcmonto', $creditosCXCMONTO)->with('fecha',$f1);
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

     public function verReciboProfesionalLab($id){
       

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
         $recibo = DB::table('atencion_profesionales_laboratorios')->select('recibo')->where('recibo', '=', $id)->get(['recibo'])->first()->recibo;  



         $reciboprofesionallab = DB::table('atencion_profesionales_laboratorios as a')
        ->select('a.id','a.id_laboratorio','a.id_profesional', 'a.recibo', 'a.id_atencion','a.created_at as fecha','a.pagado','a.id_sucursal','a.id_empresa','a.porcentaje as porlab',/*'b.id_atec_servicio',*/'b.costo','b.id_atencion','b.id_paciente','e.nombres','e.apellidos','f.name as profnombre','f.apellidos as profapellido','f.centro','d.name as detalle')
        ->join('atencion_detalles as b','a.id_atencion','b.id_atencion')
       // ->join('atencion_profesionales_servicios as c','a.id_atencion','c.id_atencion')
        ->join('analises as d','d.id','a.id_laboratorio')
        ->join('pacientes as e','e.id','b.id_paciente')
        ->join('profesionales as f','f.id','a.id_profesional')
        ->where('a.recibo','=', $recibo)
        ->where('a.pagado','=', 1)
        ->where('a.id_empresa','=', $usuarioEmp)
        ->where('a.id_sucursal','=', $usuarioSuc)
        ->get();

    

  
        if($reciboprofesionallab){
            return $reciboprofesionallab;
         }else{
            return false;
         }  

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
         $recibo = DB::table('atencion_profesionales_servicios')->select('recibo')->where('recibo', '=', $id)->get(['recibo'])->first()->recibo;  


         $reciboprofesionallab = DB::table('atencion_profesionales_laboratorios as a')
        ->select('a.id','a.id_laboratorio','a.id_profesional', 'a.recibo', 'a.id_atencion','a.created_at as fecha','a.pagado','a.pagar','a.id_sucursal','a.id_empresa','a.porcentaje as porlab','b.costo','b.id_atencion','b.id_paciente','e.nombres','e.apellidos','f.name as profnombre','f.apellidos as profapellido','f.centro','d.name as detalle')
        ->join('atencion_detalles as b','a.id_atencion','b.id_atencion')
        ->join('analises as d','a.id_laboratorio','d.id')
        ->join('pacientes as e','e.id','b.id_paciente')
        ->join('profesionales as f','f.id','a.id_profesional')
        ->where('a.recibo','=', $recibo)
        ->where('a.pagado','=', 1)
        ->where('a.id_empresa','=', $usuarioEmp)
        ->where('a.id_sucursal','=', $usuarioSuc);


         $reciboprofesional = DB::table('atencion_profesionales_servicios as a')
        ->select('a.id','a.id_servicio','a.id_profesional', 'a.recibo', 'a.id_atencion','a.created_at as fecha','a.pagado','a.pagar','a.id_sucursal','a.id_empresa','a.porcentaje',/*'b.id_atec_servicio',*/'b.costo','b.id_atencion','b.id_paciente','e.nombres','e.apellidos','f.name as profnombre','f.apellidos as profapellido','f.centro','d.detalle')
        ->join('atencion_detalles as b','a.id_atencion','b.id_atencion')
        ->join('servicios as d','d.id','a.id_servicio')
        ->join('pacientes as e','e.id','b.id_paciente')
        ->join('profesionales as f','f.id','a.id_profesional')
        ->where('a.recibo','=', $recibo)
        ->where('a.pagado','=', 1)
        ->where('a.id_empresa','=', $usuarioEmp)
        ->where('a.id_sucursal','=', $usuarioSuc)
        ->union($reciboprofesionallab)
        ->get();

       // dd($reciboprofesional);
        

  
        if($reciboprofesional){
            return $reciboprofesional;
         }else{
            return false;
         }  

     }

     public function total_serv($id){

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
         $recibo = DB::table('atencion_profesionales_servicios')->select('recibo')->where('recibo', '=', $id)->get(['recibo'])->first()->recibo;  
     
      $comisiones_serv_pag = DB::table('atencion_profesionales_servicios as a')
     ->select(DB::raw('SUM(a.pagar) as total_serv','id_empresa','a.pagado','a.id_sucursal','a.recibo','a.id','a.created_at as fecha'))
     ->where('a.recibo','=', $recibo)
     ->where('a.id_empresa','=', $usuarioEmp)
     ->where('a.id_sucursal','=', $usuarioSuc)
     ->where('a.pagado','=',1)
     //->havingRaw('SUM(a.pagar) > ?', [0])
     ->get();

     if($comisiones_serv_pag){
            return $comisiones_serv_pag;
         }else{
            return false;
         }  


     }

     public function total_lab($id){

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
         $recibo = DB::table('atencion_profesionales_servicios')->select('recibo')->where('recibo', '=', $id)->get(['recibo'])->first()->recibo;  
     
      $comisiones_lab_pag = DB::table('atencion_profesionales_laboratorios as a')
     ->select(DB::raw('SUM(a.pagar) as total_lab','id_empresa','a.pagado','a.id_sucursal','a.recibo','a.id','a.created_at as fecha'))
     ->where('a.recibo','=', $recibo)
     ->where('a.id_empresa','=', $usuarioEmp)
     ->where('a.id_sucursal','=', $usuarioSuc)
     ->where('a.pagado','=',1)
     //->havingRaw('SUM(a.pagar) > ?', [0])
     ->get();

      if($comisiones_lab_pag){
            return $comisiones_lab_pag;
         }else{
            return false;
         } 


     }

       public function profesional($id){

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
         $recibo = DB::table('atencion_profesionales_servicios')->select('recibo')->where('recibo', '=', $id)->get(['recibo'])->first()->recibo;  
     
      $profesional = DB::table('atencion_profesionales_servicios as a')
     ->select('a.id','a.id_atencion','a.id_profesional','b.name','b.apellidos','b.centro','a.recibo')
     ->join('profesionales as b','b.id','a.id_profesional')
    // ->join('atencions as c','a.id_atencion','c.id')
     ->where('a.recibo','=', $recibo)
     ->where('a.id_empresa','=', $usuarioEmp)
     ->where('a.id_sucursal','=', $usuarioSuc)
     ->where('a.pagado','=',1)
     ->groupBy('a.recibo')
     //->havingRaw('SUM(a.pagar) > ?', [0])
     ->get();

      $profesional = json_encode($profesional);
      $profesional = self::unique_multidim_array(json_decode($profesional, true), "id_atencion");

      if($profesional){
            return $profesional;
         }else{
            return false;
         } 


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

       public function recibo_profesionales_ver($id) 
    {

        $recibo = DB::table('atencion_profesionales_servicios')->select('recibo')->where('recibo', '=', $id)->get(['recibo'])->first()->recibo;  


       
       $reciboprofesional = PdfController::verReciboProfesional($id);
       $comisiones_lab_pag = PdfController::total_lab($id);
       $comisiones_serv_pag = PdfController::total_serv($id);
       $profesional = PdfController::profesional($id);
     //  $reciboprofesional = json_encode($reciboprofesional);
       //$reciboprofesional = self::unique_multidim_array(json_decode($reciboprofesional, true), "detalle");
     //  if(sizeof($reciboprofesional) > 0){
       $view = \View::make('reportes.recibo_profesionales_ver')->with('reciboprofesional', $reciboprofesional)->with('comisiones_lab_pag', $comisiones_lab_pag)->with('comisiones_serv_pag', $comisiones_serv_pag)->with('recibo', $recibo)->with('profesional',$profesional);
       $pdf = \App::make('dompdf.wrapper');
       $pdf->loadHTML($view);
       return $pdf->stream('recibo_profesionales_ver');
    /* }else{
      return response()->json([false]);
     }*/
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


        
                $servicios = DB::table('atencion_profesionales_servicios as a')
                ->select('a.id','a.id_atencion','a.id_servicio','a.pagado','a.id_empresa','a.id_sucursal','a.created_at','d.detalle as detalleservicio','e.id_paciente','f.nombres','f.apellidos','a.status_redactar_resultados','h.descripcion as resultado','i.recibo')
                ->join('empresas as b','a.id_empresa','b.id')
                ->join('locales as c','a.id_sucursal','c.id')
                ->join('servicios as d','a.id_servicio','d.id')
                ->join('atencion_detalles as e','a.id_atencion','e.id_atencion')
                ->join('pacientes as f','f.id','e.id_paciente')
                ->join('redactar_resultados as h','a.id','h.id_atencion_servicio')
                ->join('atencion_servicios as i','i.id_atencion','a.id_atencion')
                ->where('a.status_redactar_resultados','=',1)
                ->where('a.id_empresa','=', $usuarioEmp)
                ->where('a.id_sucursal','=', $usuarioSuc)
                ->groupBy('i.recibo')
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

       public function verResultadoLab($id){
       

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


        
                $laboratorios = DB::table('atencion_profesionales_laboratorios as a')
                ->select('a.id','a.id_atencion','a.id_laboratorio','a.pagado','a.id_empresa','a.id_sucursal','a.created_at','d.name as detalleservicio','e.id_paciente','f.nombres','f.apellidos','a.status_redactar_resultados','h.descripcion as resultado','i.recibo')
                ->join('empresas as b','a.id_empresa','b.id')
                ->join('locales as c','a.id_sucursal','c.id')
                ->join('analises as d','a.id_laboratorio','d.id')
                ->join('atencion_detalles as e','a.id_atencion','e.id_atencion')
                ->join('pacientes as f','f.id','e.id_paciente')
                ->join('redactar_resultados_labs as h','a.id','h.id_atencion_lab')
                ->join('atencion_laboratorios as i','i.id_atencion','a.id_atencion')
                ->where('a.status_redactar_resultados','=',1)
                ->where('a.id_empresa','=', $usuarioEmp)
                ->where('a.id_sucursal','=', $usuarioSuc)
                ->groupBy('i.recibo')
                ->where('a.id','=', $id)
                    //->whereDate('a.created_at', '=', Carbon::now()->format('Y-m-d'))
                ->orderby('a.created_at','desc')
                ->get();
             

        if(!is_null($laboratorios)){
            return $laboratorios;
         }else{
            return false;
         }  

     }


        public function resultados_lab_ver($id) 
    {
       
     $laboratorios =PdfController::verResultadoLab($id);

     $view = \View::make('reportes.resultados_lab_ver')->with('laboratorios', $laboratorios);
     $pdf = \App::make('dompdf.wrapper');
     $pdf->loadHTML($view);
     
       
        return $pdf->stream('resultados_lab_ver');

    }

     public function verResultadoPaqLab($id){
       

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


    

                 $paquetes = DB::table('atencion_profesionales_paquete_labs as a')
                ->select('a.id', 'a.id_atencion', 'a.id_paquete','a.id_laboratorio', 'a.pagado', 'a.porcentajepaq as porcentaje',
                    'a.recibo', 'a.created_at as fecha','a.status_redactar_resultados','a.id_profesional', 'b.costo','b.id_paciente','b.costoa', 'f.name as nombres',
                    'f.apellidos', 'b.origen', 'p.nombres as pnombres', 'p.apellidos as papellidos','c.name as detalle','c.costo as precio','i.name as detalle1','h.descripcion as resultado')
                ->join('profesionales as f','f.id','a.id_profesional')
                ->join('atencion_detalles as b','a.id_atencion','b.id_atencion')
                ->join('pacientes as p','p.id','b.id_paciente')
                ->join('paquetes as c','c.id','a.id_paquete')
                ->join('analises as i','i.id','a.id_laboratorio')
                ->join('redactar_resultados_paq_labs as h','a.id','h.id_atencion_lab')
                ->where('a.status_redactar_resultados','=',1)
                ->where('a.id_empresa','=', $usuarioEmp)
                ->where('a.id_sucursal','=', $usuarioSuc)
                ->where('a.id','=', $id)
                ->get();
             

        if(!is_null($paquetes)){
            return $paquetes;
         }else{
            return false;
         }  

     }


        public function resultados_lab_paq_ver($id) 
    {
       
     $paqueteslab =PdfController::verResultadoPaqLab($id);

     $view = \View::make('reportes.resultados_lab_paq_ver')->with('paqueteslab', $paqueteslab);
     $pdf = \App::make('dompdf.wrapper');
     $pdf->loadHTML($view);
     
       
        return $pdf->stream('resultados_lab_paq_ver');

    }

    public function verResultadoPaqServ($id){
       

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


    

                 $paquetes = DB::table('atencion_profesionales_paquetes as a')
                ->select('a.id', 'a.id_atencion', 'a.id_paquete','a.id_servicio', 'a.pagado', 'a.porcentajepaq as porcentaje',
                    'a.recibo', 'a.created_at as fecha','a.status_redactar_resultados','a.id_profesional', 'b.costo','b.id_paciente','b.costoa', 'f.name as nombres',
                    'f.apellidos', 'b.origen', 'p.nombres as pnombres', 'p.apellidos as papellidos','c.name as detalle','c.costo as precio','i.detalle as detalle1','h.descripcion as resultado')
                ->join('profesionales as f','f.id','a.id_profesional')
                ->join('atencion_detalles as b','a.id_atencion','b.id_atencion')
                ->join('pacientes as p','p.id','b.id_paciente')
                ->join('paquetes as c','c.id','a.id_paquete')
                ->join('servicios as i','i.id','a.id_servicio')
                ->join('redactar_resultados_paq_servs as h','a.id','h.id_atencion_ser')
                ->where('a.status_redactar_resultados','=',1)
                ->where('a.id_empresa','=', $usuarioEmp)
                ->where('a.id_sucursal','=', $usuarioSuc)
                ->where('a.id','=', $id)
                ->get();
             

        if(!is_null($paquetes)){
            return $paquetes;
         }else{
            return false;
         }  

     }


        public function resultados_lab_paq_serv($id) 
    {
       
     $paquetesserv =PdfController::verResultadoPaqServ($id);

     $view = \View::make('reportes.resultados_lab_paq_serv_ver')->with('paquetesserv', $paquetesserv);
     $pdf = \App::make('dompdf.wrapper');
     $pdf->loadHTML($view);
     
       
        return $pdf->stream('resultados_lab_paq_ver');

    }

     public function ticketAtencion($id){
       

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


        
                $atencion = DB::table('atencions as a')
                ->select('a.id','a.created_at','d.id_atencion','d.id_paciente','d.costo','d.costoa','d.porcentaje','d.acuenta','d.pendiente','d.observaciones','d.id_paciente','d.origen','d.id_profesional','g.name','g.apellidos')
                ->join('atencion_detalles as d','a.id','d.id_atencion')
               // ->join('atencion_profesionales_servicios as f','a.id','f.id_atencion')
                //->join('atencion_profesionales_laboratorios as h','a.id','h.id_atencion')
                ->join('profesionales as g','g.id','d.id_profesional')
                ->where('a.id_empresa','=', $usuarioEmp)
                ->where('a.id_sucursal','=', $usuarioSuc)
                ->where('a.id','=', $id)
                ->groupBy('a.id')
                ->orderby('a.created_at','desc')
                ->get();
                
        if(!is_null($atencion)){
            return $atencion;
         }else{
            return false;
         }  

     }



       public function ticket_atencion_ver($id) 
    {
       
     $atencion =PdfController::ticketAtencion($id);
     
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

     $servicios = new Servicios();
     $analisis = new Analisis();
     $paquete = new Paquetes();
     $paquetes = new PaquetesServ();
     $atenciondetalle = new AtencionDetalle();


     $view = \View::make('reportes.ticket_atencion_ver')->with('atencion', $atencion)->with('servicios', $servicios)->with('analisis', $analisis)->with('paquete', $paquete)->with('paquetes', $paquetes)->with('atenciondetalle', $atenciondetalle)->with('usuarioEmp', $usuarioEmp)->with('usuarioSuc', $usuarioSuc);
     $pdf = \App::make('dompdf.wrapper');
     $pdf->loadHTML($view);
     
       
        return $pdf->stream('ticket_atencion_ver');

    }




}
