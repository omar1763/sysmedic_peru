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

        $comisiones = DB::table('atencion_profesionales_servicios as a')
        ->select('a.id','a.id_servicio','a.id_profesional','a.id_servicio','a.created_at as fecha','a.pagado','a.id_sucursal','a.id_empresa','b.costo','b.id_paciente','d.detalle','d.porcentaje','e.nombres','e.apellidos','f.name as profnombre','f.apellidos as profapellido')
        ->join('atencion_detalles as b','a.id','b.id_atencion')
        ->join('servicios as d','d.id','a.id_servicio')
        ->join('pacientes as e','e.id','b.id_paciente')
        ->join('profesionales as f','f.id','a.id_profesional')
        ->where('a.pagado','=',0)
        ->where('a.id_empresa','=', $usuarioEmp)
        ->where('a.id_sucursal','=', $usuarioSuc)
        ->whereBetween('a.created_at', [$f1, $f2])
       // ->where('a.created_at','=', $f1)
        ->orderby('a.created_at','desc')
        ->paginate(5000);

         $comisioneslab = DB::table('atencion_profesionales_laboratorios as a')
        ->select('a.id','a.id_profesional','a.id_laboratorio','a.created_at as fecha','a.pagado','a.id_sucursal','a.id_empresa','b.costo','b.id_paciente','d.name','d.porcentaje','e.nombres','e.apellidos','f.name as profnombre','f.apellidos as profapellido')
        ->join('atencion_detalles as b','a.id','b.id_atencion')
        ->join('analises as d','d.id','a.id_laboratorio')
        ->join('pacientes as e','e.id','b.id_paciente')
        ->join('profesionales as f','f.id','a.id_profesional')
        ->where('a.pagado','=',0)
        ->where('a.id_empresa','=', $usuarioEmp)
        ->where('a.id_sucursal','=', $usuarioSuc)
        ->whereBetween('a.created_at', [$f1, $f2])
       // ->where('a.created_at','=', $f1)
        ->orderby('a.created_at','desc')
        ->paginate(5000);
  

        return view('existencias.comisiones.index', compact('comisiones','comisioneslab'));
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

         $searchAtecProLab = DB::table('atencion_profesionales_laboratorios')
                    ->select('*')
                   // ->where('estatus','=','1')
                    ->where('id','=', $id)
                    ->get();

            foreach ($searchAtecProLab as $atecprolab) {
                    $id_atencion = $atecprolab->id_atencion;
                    $id_laboratorio = $atecprolab->id_laboratorio;
                }
     
        if(! is_null($id_servicio)) {   

        $atencionproser = AtencionProfesionalesServicio::findOrFail($id);
        $atencionproser->pagado = 1;
        $atencionproser->update();

       $debitos = new Debitos;
       $debitos->descripcion =$detalle;
       $debitos->monto     =$porcentaje;
       $debitos->origen     ='COMISIONES POR PAGAR';
       $debitos->id_empresa     =$usuarioEmp;
       $debitos->id_sucursal     =$usuarioSuc;
       $debitos->save();
       
        } else if(! is_null($id_laboratorio)) {

        
        $atencionprolab = AtencionProfesionalesLaboratorio::findOrFail($id);
        $atencionprolab->pagado = 1;
        dd($id);
        die();
        $atencionprolab->update();


        }
       // 
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
        if (! Gate::allows('users_manage')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Gastos::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }

}
