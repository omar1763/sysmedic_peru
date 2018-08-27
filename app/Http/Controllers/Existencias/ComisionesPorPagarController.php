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


       $comisionesserv = DB::table('atencion_servicios as a')
        ->select('a.id','a.id_servicio','a.id_profesional','a.id_atencion','a.origen','a.created_at as fecha','a.pagado','a.id_sucursal','a.id_empresa','a.porcentaje','b.costo','b.id_atencion','b.id_paciente','e.nombres','e.apellidos','f.name as profnombre','f.apellidos as profapellido')
        ->join('atencion_detalles as b','a.id_atencion','b.id_atencion')
        //->join('atencion_profesionales_servicios as c','a.id_profesional','c.id_profesional')
        //->join('servicios as d','d.id','c.id_servicio')
        ->join('pacientes as e','e.id','b.id_paciente')
        ->join('profesionales as f','f.id','a.id_profesional')
        //->groupBy('a.id','a.id_profesional')
        ->where('a.pagado','=',0)
        ->where('a.id_empresa','=', $usuarioEmp)
        ->where('a.id_sucursal','=', $usuarioSuc)
        ->whereBetween('a.created_at', [$f1, $f2]);
        

        $comisiones = DB::table('atencion_laboratorios as a')
       ->select('a.id','a.id_analisis','a.id_profesional','a.id_atencion','a.origen','a.created_at as fecha','a.pagado','a.id_sucursal','a.id_empresa','a.porcentaje','b.costo','b.id_atencion','b.id_paciente','e.nombres','e.apellidos','f.name as profnombre','f.apellidos as profapellido')
        ->join('atencion_detalles as b','a.id_atencion','b.id_atencion')
        //->join('atencion_profesionales_laboratorios as c','a.id_profesional','c.id_profesional')
       // ->join('analises as d','d.id','c.id_laboratorio')
        ->join('pacientes as e','e.id','b.id_paciente')
        ->join('profesionales as f','f.id','a.id_profesional')
        ->where('a.pagado','=',0)
        ->where('a.id_empresa','=', $usuarioEmp)
        ->where('a.id_sucursal','=', $usuarioSuc)
        ->whereBetween('a.created_at', [$f1, $f2])
        ->union($comisionesserv)
       // ->where('a.created_at','=', $f1)
        ->orderby('fecha','desc')
        ->get();


        $servicios = new Servicios();
        $analisis = new Analisis();


  

        return view('existencias.comisiones.index', compact('comisiones','analisis','servicios'));
    }


    public function destroy($id)
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

                  $searchAtecProSer = DB::table('atencion_profesionales_servicios')
                   ->select('*')
                   // ->where('estatus','=','1')
                   ->where('id','=', $id)
                   ->get();

                   foreach ($searchAtecProSer as $atecpro) {
                    $id_prof_serv = $atecpro->id;
                    $id_atencion = $atecpro->id_atencion;
                    $id_servicio = $atecpro->id_servicio;
                }

                $searchSer = DB::table('servicios')
                ->select('*')
                   // ->where('estatus','=','1')
                ->where('id','=', $id_servicio)
                ->get();

                foreach ($searchSer as $servicios) {
                    $detalle = $servicios->detalle;
                    $porcentaje = $servicios->porcentaje;
                }


                $recibo =rand(1,99999);

                $atencionproser = AtencionServicios::findOrFail($id);
                $atencionproser->pagado = 1;
                $atencionproser->recibo =$recibo;
                $atencionproser->update();


                $debitos = new Debitos;
                $debitos->descripcion =$detalle;
                $debitos->monto     =$porcentaje;
                $debitos->origen     ='COMISIONES POR PAGAR';
                $debitos->id_empresa     =$usuarioEmp;
                $debitos->id_sucursal     =$usuarioSuc;
                $debitos->save();

              //  $atencionprolab=AtencionLaboratorio::findOrFail($id);
               // $atencionprolab->pagado=1;
                //$atencionprolab->recibo =$recibo;
                //$atencionprolab->update();

      //  return view('existencias.comisiones.index');
       return redirect()->route('admin.comisionesporpagar.index');
    }

    /**
     * Delete all selected User at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        

       
      
        if ($request->input('ids')) {
            $entries = AtencionServicios::whereIn('id', $request->input('ids'))->get();
            $entries1 = AtencionLaboratorio::whereIn('id', $request->input('ids'))->get();
            $entries2 = AtencionProfesionalesServicio::whereIn('id', $request->input('ids'))->get();
  
           $recibo =rand(1,99999);

            foreach ($entries as $entry) {
                $entry->pagado= 1;
                $entry->recibo= $recibo;
                $entry->update(); 

            }

             foreach ($entries2 as $entry) {
                $entry->pagado= 1;
                $entry->recibo= $recibo;
                $entry->update(); 

            }

                 
        }
       
    }

}
