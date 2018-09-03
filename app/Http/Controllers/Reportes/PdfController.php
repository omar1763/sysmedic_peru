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
        ->select('a.id','a.id_laboratorio','a.id_profesional', 'a.recibo', 'a.id_atencion','a.created_at as fecha','a.pagado','a.id_sucursal','a.id_empresa','a.porcentaje as porlab',/*'b.id_atec_servicio',*/'b.costo','b.id_atencion','b.id_paciente','e.nombres','e.apellidos','f.name as profnombre','f.apellidos as profapellido','f.centro','d.name as detalle')
        ->join('atencion_detalles as b','a.id_atencion','b.id_atencion')
       // ->join('atencion_profesionales_servicios as c','a.id_atencion','c.id_atencion')
        ->join('analises as d','d.id','a.id_laboratorio')
        ->join('pacientes as e','e.id','b.id_paciente')
        ->join('profesionales as f','f.id','a.id_profesional')
        ->where('a.recibo','=', $recibo)
        ->where('a.pagado','=', 1)
        ->where('a.id_empresa','=', $usuarioEmp)
        ->where('a.id_sucursal','=', $usuarioSuc);

         $reciboprofesional = DB::table('atencion_profesionales_servicios as a')
        ->select('a.id','a.id_servicio','a.id_profesional', 'a.recibo', 'a.id_atencion','a.created_at as fecha','a.pagado','a.id_sucursal','a.id_empresa','a.porcentaje',/*'b.id_atec_servicio',*/'b.costo','b.id_atencion','b.id_paciente','e.nombres','e.apellidos','f.name as profnombre','f.apellidos as profapellido','f.centro','d.detalle')
        ->join('atencion_detalles as b','a.id_atencion','b.id_atencion')
       // ->join('atencion_profesionales_servicios as c','a.id_atencion','c.id_atencion')
        ->join('servicios as d','d.id','a.id_servicio')
        ->join('pacientes as e','e.id','b.id_paciente')
        ->join('profesionales as f','f.id','a.id_profesional')
        ->where('a.recibo','=', $recibo)
        ->where('a.pagado','=', 1)
        ->where('a.id_empresa','=', $usuarioEmp)
        ->where('a.id_sucursal','=', $usuarioSuc)
        ->union($reciboprofesionallab)
        ->get();


  
        if($reciboprofesional){
            return $reciboprofesional;
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
       
       $reciboprofesional = PdfController::verReciboProfesional($id);
       $reciboprofesional = json_encode($reciboprofesional);
       $reciboprofesional = self::unique_multidim_array(json_decode($reciboprofesional, true), "detalle");
       if(sizeof($reciboprofesional) > 0){
       $view = \View::make('reportes.recibo_profesionales_ver', ['reciboprofesional' => $reciboprofesional, 'profnombre' => $reciboprofesional[0]["profnombre"], 'profapellido' => $reciboprofesional[0]["profapellido"], "centro" => $reciboprofesional[0]["centro"], "recibo" => $reciboprofesional[0]["recibo"], "porcentaje" => $reciboprofesional[0]["porcentaje"]])->render();
       $pdf = \App::make('dompdf.wrapper');
       $pdf->loadHTML($view);


       return $pdf->stream('recibo_profesionales_ver');
     }else{
      return response()->json([false]);
     }
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




}
