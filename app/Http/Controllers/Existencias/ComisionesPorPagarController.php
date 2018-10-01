<?php

namespace App\Http\Controllers\Existencias;

use App\Atencion;
use App\AtencionDetalle;
use App\AtencionLaboratorio;
use App\AtencionServicios;
use App\AtencionProfesionalesServicio;
use App\AtencionProfesionalesLaboratorio;
use App\Pacientes;
use App\Profesionales;
use App\Servicios;
use App\Analisis;
use App\Debitos;
use App\Empresas;
use App\Locales;
use App\Recibos;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;


class ComisionesPorPagarController extends Controller
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
        
        $usuario = Auth::user();
        $usuarioEmp = $usuario->id_empresa;
        $usuarioSuc = $usuario->id_sucursal;

        $f1 = date('YYYY-m-d');
        $f2 = date('YYYY-m-d');

        $f1 = $request->fecha;
        $f2 = $request->fecha2;
        /*
       $comisionesserv = DB::table('atencion_servicios as a')
        ->select('a.id','a.id_servicio','a.id_profesional','a.id_atencion','a.origen','a.created_at as fecha','a.pagado','a.id_sucursal','a.id_empresa','a.porcentaje','b.costo','b.id_atencion','b.id_paciente','e.nombres','e.apellidos','f.name as profnombre','f.apellidos as profapellido')
        ->join('atencion_detalles as b','a.id_atencion','b.id_atencion')
        ->join('atencion_profesionales_servicios as c','a.id_profesional','c.id_profesional')
        ->join('servicios as d','d.id','c.id_servicio')
        ->join('pacientes as e','e.id','b.id_paciente')
        ->join('profesionales as f','f.id','a.id_profesional')
        //->groupBy('a.id','a.id_profesional')
        ->where('a.pagado','=',0)
        ->where('a.id_empresa','=', $usuarioEmp)
        ->where('a.id_sucursal','=', $usuarioSuc)
        ->groupBy('a.id_atencion')
        ->whereBetween('a.created_at', [$f1, $f2]);
        
        */

     $comisiones_lab_pag = DB::table('atencion_profesionales_laboratorios as a')
     ->select(DB::raw('SUM(a.pagar) as total_lab','id_empresa','a.pagado','a.id_sucursal','a.id','a.created_at as fecha','a.updated_at'))
     ->where('a.id_empresa','=', $usuarioEmp)
     ->where('a.id_sucursal','=', $usuarioSuc)
     ->where('a.pagado','=',0)
     ->whereBetween('a.updated_at', [$f1, $f2])
     //->havingRaw('SUM(a.pagar) > ?', [0])
     ->get();

      $comisiones_serv_pag = DB::table('atencion_profesionales_servicios as a')
     ->select(DB::raw('SUM(a.pagar) as total_serv','id_empresa','a.pagado','a.id_sucursal','a.id','a.created_at as fecha','a.updated_at'))
     ->where('a.id_empresa','=', $usuarioEmp)
     ->where('a.id_sucursal','=', $usuarioSuc)
     ->where('a.pagado','=',0)
     ->whereBetween('a.updated_at', [$f1, $f2])
     //->havingRaw('SUM(a.pagar) > ?', [0])
     ->get();

       $comisiones_lab = DB::table('atencion_profesionales_laboratorios as a')
        ->select('a.id', 'a.id_atencion', 'a.id_laboratorio as id_servicio', 'a.pagado', 'a.porcentaje',
        'a.recibo', 'a.created_at as fecha','a.updated_at','a.pagar', 'b.costo', 'f.name as nombres',
        'f.apellidos', 's.origen', 'p.nombres as pnombres', 'p.apellidos as papellidos','c.name as detalle','c.preciopublico as precio','a.id_profesional')
        ->join('profesionales as f','f.id','a.id_profesional')
        ->join('atencion_detalles as b','a.id_atencion','b.id_atencion')
        ->join('pacientes as p','p.id','b.id_paciente')
        ->join('atencion_laboratorios as s', 'a.id_atencion', 's.id_atencion')
        ->join('analises as c','c.id','a.id_laboratorio')
        ->where('a.id_profesional','<>',999)
        ->where('a.pagado','=',0)
        ->where('a.id_empresa','=', $usuarioEmp)
        ->where('a.id_sucursal','=', $usuarioSuc)
        ->whereBetween('a.updated_at', [$f1, $f2]);

        $comisiones = DB::table('atencion_profesionales_servicios as a')
        ->select('a.id', 'a.id_atencion', 'a.id_servicio', 'a.pagado', 'a.porcentaje', 'a.recibo', 'a.created_at as fecha','a.updated_at','a.pagar', 'b.costo', 'f.name as nombres', 'f.apellidos', 's.origen', 'p.nombres as pnombres', 'p.apellidos as papellidos','c.detalle as detalle','c.precio','a.id_profesional')
        ->join('profesionales as f','f.id','a.id_profesional')
        ->join('atencion_detalles as b','a.id_atencion','b.id_atencion')
        ->join('pacientes as p','p.id','b.id_paciente')
        ->join('atencion_servicios as s', 'a.id_atencion', 's.id_atencion')
        ->join('servicios as c','c.id','a.id_servicio')
        ->where('a.id_profesional','<>',999)
        ->where('a.id_empresa','=', $usuarioEmp)
        ->where('a.id_sucursal','=', $usuarioSuc)
        ->where('a.pagado', '=', 0)
        ->whereBetween('a.updated_at', [$f1, $f2])
        ->union($comisiones_lab)
        ->get();

      

        $servicios = new Servicios();
        $analisis = new Analisis();


  

        return view('existencias.comisiones.index', compact('comisiones','analisis','servicios','comisiones_lab_pag','comisiones_serv_pag'));
    }

    public function pendientePagarLab(){

     $usuario = Auth::user();
     $usuarioEmp = $usuario->id_empresa;
     $usuarioSuc = $usuario->id_sucursal;


     $comisiones_lab = DB::table('atencion_profesionales_laboratorios as a')
     ->select(DB::raw('SUM(a.pagar) as total_lab','id_empresa','a.pagado','a.id_sucursal','a.id','a.created_at as fecha'))
     ->where('a.id_empresa','=', $usuarioEmp)
     ->where('a.id_sucursal','=', $usuarioSuc)
     ->where('a.pagado','=',0)
     ->havingRaw('SUM(a.pagar) > ?', [0])
     ->get();

     return view('existencias.comisiones.index', compact('comisiones_lab'));

    }

     public function pendientePagarServ(){

     $usuario = Auth::user();
     $usuarioEmp = $usuario->id_empresa;
     $usuarioSuc = $usuario->id_sucursal;


     $comisiones_serv = DB::table('atencion_profesionales_servicios as a')
     ->select(DB::raw('SUM(a.pagar) as total_serv','id_empresa','a.pagado','a.id_sucursal','a.id','a.created_at as fecha'))
     ->where('a.id_empresa','=', $usuarioEmp)
     ->where('a.id_sucursal','=', $usuarioSuc)
     ->where('a.pagado','=',0)
     ->havingRaw('SUM(a.pagar) > ?', [0])
     ->get();

     return view('existencias.comisiones.index', compact('comisiones_serv'));

    }

    public function searchID($id){

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

        $searchid = DB::table('atencion_profesionales_servicios')
                    ->select('*')
                   // ->where('estatus','=','1')
                    ->where('id','=', $id)
                    ->where('id_empresa','=',$usuarioEmp)
                    ->where('id_sucursal','=',$usuarioSuc)
                    ->get();

           if (count($searchid) > 0){

              return true;
           } else {

              return false;
           }

    }


    public function destroy($id)
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

     $fecha = Carbon::now()->format('Y-m-d');
 

     If (ComisionesPorPagarController::searchID($id)){ 


                  $searchAtecProSer = DB::table('atencion_profesionales_servicios')
                   ->select('*')
                   // ->where('estatus','=','1')
                   ->where('id','=', $id)
                   ->get();

                   foreach ($searchAtecProSer as $atecpro) {
                    $id_prof_serv = $atecpro->id;
                    $id_atencion = $atecpro->id_atencion;
                    $id_servicio = $atecpro->id_servicio;
                    $pagar= $atecpro->pagar;
                }


                $searchSer = DB::table('servicios')
                ->select('*')
                   // ->where('estatus','=','1')
                ->where('id','=', $id_servicio)
                ->get();

                foreach ($searchSer as $servicios) {
                    $detalle = $servicios->detalle;
                    $porcentaje = $servicios->precio;
                }

                $recibo =rand(1,99999);

           


                $atencionproser=AtencionServicios::where("id","=",$id)
                                                      ->update(['pagado' => 1,'recibo' => $recibo,'fecha_pago_comision' => $fecha]);

                $atencionprofser=AtencionProfesionalesServicio::where("id","=",$id)
                                                      ->update(['pagado' => 1,'recibo' => $recibo,'fecha_pago_comision' => $fecha]);
                $debitos = new Debitos;
                $debitos->descripcion =$detalle;
                $debitos->monto     =$pagar;
                $debitos->origen     ='COMISIONES POR PAGAR';
                $debitos->id_empresa     =$usuarioEmp;
                $debitos->id_sucursal     =$usuarioSuc;
                $debitos->save();

            } else {

                 $searchAtecProSer = DB::table('atencion_profesionales_laboratorios')
                   ->select('*')
                   // ->where('estatus','=','1')
                   ->where('id','=', $id)
                   ->get();

                   foreach ($searchAtecProSer as $atecpro) {
                    $id_prof_serv = $atecpro->id;
                    $id_atencion = $atecpro->id_atencion;
                    $id_laboratorio = $atecpro->id_laboratorio;
                }


                $searchSer = DB::table('analises')
                ->select('*')
                   // ->where('estatus','=','1')
                ->where('id','=', $id_laboratorio)
                ->get();

                foreach ($searchSer as $servicios) {
                    $detalle = $servicios->name;
                    $porcentaje = $servicios->porcentaje;
                }

                $recibo =rand(1,99999);
                $fecha = date('YYYY-m-d');


                $atencionproser=AtencionLaboratorio::where("id","=",$id)
                                                      ->update(['pagado' => 1,'recibo' => $recibo,'fecha_pago_comision' => $fecha]);

                $atencionprofser=AtencionProfesionalesLaboratorio::where("id","=",$id)
                                                      ->update(['pagado' => 1,'recibo' => $recibo,'fecha_pago_comision' => $fecha]);

                $debitos = new Debitos;
                $debitos->descripcion =$detalle;
                $debitos->monto     =$porcentaje;
                $debitos->origen     ='COMISIONES POR PAGAR';
                $debitos->id_empresa     =$usuarioEmp;
                $debitos->id_sucursal     =$usuarioSuc;
                $debitos->save();


             

            }

             return redirect()->route('admin.comisionesporpagar.index');
    }

    public function destroylab($id)
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

         

                  $searchAtecProSer = DB::table('atencion_profesionales_laboratorios')
                   ->select('*')
                   // ->where('estatus','=','1')
                   ->where('id','=', $id)
                   ->get();

                   foreach ($searchAtecProSer as $atecpro) {
                    $id_prof_serv = $atecpro->id;
                    $id_atencion = $atecpro->id_atencion;
                    $id_laboratorio = $atecpro->id_laboratorio;
                }


                $searchSer = DB::table('analises')
                ->select('*')
                   // ->where('estatus','=','1')
                ->where('id','=', $id_laboratorio)
                ->get();

                foreach ($searchSer as $servicios) {
                    $detalle = $servicios->name;
                    $porcentaje = $servicios->porcentaje;
                }

                $recibo =rand(1,99999);
                $fecha = date('YYYY-m-d');


                $atencionproser=AtencionLaboratorio::where("id_atencion","=",$id_atencion)
                                                      ->update(['pagado' => 1,'recibo' => $recibo,'fecha_pago_comision' => $fecha]);

                $atencionprofser=AtencionProfesionalesLaboratorio::where("id_atencion","=",$id_atencion)
                                                      ->update(['pagado' => 1,'recibo' => $recibo,'fecha_pago_comision' => $fecha]);

                $debitos = new Debitos;
                $debitos->descripcion =$detalle;
                $debitos->monto     =$porcentaje;
                $debitos->origen     ='COMISIONES POR PAGAR';
                $debitos->id_empresa     =$usuarioEmp;
                $debitos->id_sucursal     =$usuarioSuc;
                $debitos->save();

             return redirect()->route('admin.comisionesporpagar.index');
    }

    /**
     * Delete all selected User at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        $fecha = Carbon::now()->format('Y-m-d');
      
        if ($request->input('ids')) {
            $entries = AtencionServicios::whereIn('id', $request->input('ids'))->get();
            $entries1 = AtencionLaboratorio::whereIn('id', $request->input('ids'))->get();
            $entries2 = AtencionProfesionalesServicio::whereIn('id', $request->input('ids'))->get();
            $entries3 = AtencionProfesionalesLaboratorio::whereIn('id', $request->input('ids'))->get();


          $recibo =rand(1,99999);

           foreach ($entries as $entry) {
            $entry->pagado= 1;
            $entry->recibo= $recibo;
            $entry->save(); 

          }

          foreach ($entries1 as $entry) {
            $entry->pagado= 1;
            $entry->recibo= $recibo;
            $entry->save(); 

          }


          foreach ($entries2 as $entry) {
            $entry->pagado= 1;
            $entry->recibo= $recibo;
            $entry->fecha_pago_comision= $fecha;
            $entry->save(); 

          }

          foreach ($entries3 as $entry) {
            $entry->pagado= 1;
            $entry->recibo= $recibo;
            $entry->fecha_pago_comision= $fecha;
            $entry->save(); 

          }

                 
        }
       
    }

}
