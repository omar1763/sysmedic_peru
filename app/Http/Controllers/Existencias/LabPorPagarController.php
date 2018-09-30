<?php

namespace App\Http\Controllers\Existencias;

use App\AtencionLaboratorio;
use App\AtencionProfesionalesLaboratorio;
use App\AtencionProfesionalesPaqueteLab;
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


class LabPorPagarController extends Controller
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

    if(! is_null($request->fecha)) {
        $f1 = $request->fecha;


          $labporpagar1 = DB::table('atencion_profesionales_laboratorios as a')
       ->select('a.id','a.id_atencion','a.id_laboratorio','a.pagado','a.pagadolab','d.costlab','a.id_empresa','a.id_sucursal','d.name','e.id_paciente','e.id_atencion','f.nombres as nombres','f.apellidos as apellidos')
        ->join('empresas as b','a.id_empresa','b.id')
        ->join('locales as c','a.id_sucursal','c.id')
        ->join('analises as d','a.id_laboratorio','d.id')
        ->join('atencion_detalles as e','e.id_atencion','a.id_atencion')
        ->join('pacientes as f','f.id','e.id_paciente')
        ->where('a.pagadolab','=',FALSE)
        ->where('a.id_empresa','=', $usuarioEmp)
        ->where('a.id_sucursal','=', $usuarioSuc)
        ->where('a.created_at','=', $f1)
        ->orderby('a.created_at','desc');
      

          $labporpagar = DB::table('atencion_profesionales_paquete_labs as a')
        ->select('a.id','a.id_atencion','a.id_laboratorio','a.pagado','pagadolab','d.costlab','a.id_empresa','a.id_sucursal','d.name','e.id_paciente','e.id_atencion','f.nombres as nombres','f.apellidos as apellidos')
        ->join('empresas as b','a.id_empresa','b.id')
        ->join('locales as c','a.id_sucursal','c.id')
        ->join('analises as d','a.id_laboratorio','d.id')
        ->join('atencion_detalles as e','e.id_atencion','a.id_atencion')
        ->join('pacientes as f','f.id','e.id_paciente')
        ->where('a.pagadolab','=',FALSE)
        ->where('a.id_empresa','=', $usuarioEmp)
        ->where('a.id_sucursal','=', $usuarioSuc)
        ->where('a.created_at','=', $f1)
        ->union($labporpagar1)
        ->get();

    } else {

         $labporpagar1 = DB::table('atencion_profesionales_laboratorios as a')
       ->select('a.id','a.id_atencion','a.id_laboratorio','a.pagado','a.pagadolab','d.costlab','a.id_empresa','a.id_sucursal','d.name','e.id_paciente','e.id_atencion','f.nombres as nombres','f.apellidos as apellidos')
        ->join('empresas as b','a.id_empresa','b.id')
        ->join('locales as c','a.id_sucursal','c.id')
        ->join('analises as d','a.id_laboratorio','d.id')
        ->join('atencion_detalles as e','e.id_atencion','a.id_atencion')
        ->join('pacientes as f','f.id','e.id_paciente')
        ->where('a.pagadolab','=',FALSE)
        ->where('a.id_empresa','=', $usuarioEmp)
        ->where('a.id_sucursal','=', $usuarioSuc)
        ->whereDate('a.created_at', '=', Carbon::now()->format('Y-m-d'))
        ->orderby('a.created_at','desc');
       

        $labporpagar = DB::table('atencion_profesionales_paquete_labs as a')
        ->select('a.id','a.id_atencion','a.id_laboratorio','a.pagado','a.pagadolab','d.costlab','a.id_empresa','a.id_sucursal','d.name','e.id_paciente','e.id_atencion','f.nombres as nombres','f.apellidos as apellidos')
        ->join('empresas as b','a.id_empresa','b.id')
        ->join('locales as c','a.id_sucursal','c.id')
        ->join('analises as d','a.id_laboratorio','d.id')
        ->join('atencion_detalles as e','e.id_atencion','a.id_atencion')
        ->join('pacientes as f','f.id','e.id_paciente')
        ->where('a.pagadolab','=',FALSE)
        ->where('a.id_empresa','=', $usuarioEmp)
        ->where('a.id_sucursal','=', $usuarioSuc)
        ->whereDate('a.created_at', '=', Carbon::now()->format('Y-m-d'))
        ->union($labporpagar1)
        ->get();

}


        return view('existencias.labporpagar.index', compact('labporpagar'));
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

        $searchid = DB::table('atencion_profesionales_laboratorios')
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


       If (LabPorPagarController::searchID($id)){ 

           
        $searchAtencionLaboratorio =  DB::table('atencion_profesionales_laboratorios')
                    ->select('*')
                   // ->where('estatus','=','1')
                    ->where('id','=', $id)
                    ->get();

        foreach ($searchAtencionLaboratorio as $ateclab) {
                    $idAnalisis = $ateclab->id_laboratorio;
                }


        $searchAnalisis = DB::table('analises')
                    ->select('*')
                   // ->where('estatus','=','1')
                    ->where('id','=', $idAnalisis)
                    ->get();

            foreach ($searchAnalisis as $analisis) {
                    $montoAnalisis = $analisis->costlab;
                    $nameAnalisis = $analisis->name;
                }



        $atenciolab = AtencionProfesionalesLaboratorio::findOrFail($id);
        $atenciolab->pagadolab = 1;
        $atenciolab->update();

       $debitos = new Debitos;
       $debitos->descripcion =$nameAnalisis;
       $debitos->monto     =$montoAnalisis;
       $debitos->origen     ='LABORATORIOS POR PAGAR';
       $debitos->id_empresa     =$usuarioEmp;
       $debitos->id_sucursal     =$usuarioSuc;
       $debitos->save();

   } else {

     $searchAtencionPaqLaboratorio =  DB::table('atencion_profesionales_paquete_labs')
                    ->select('*')
                   // ->where('estatus','=','1')
                    ->where('id','=', $id)
                    ->get();

        foreach ($searchAtencionPaqLaboratorio as $ateclab) {
                    $idAnalisis = $ateclab->id_laboratorio;
                }


        $searchAnalisis = DB::table('analises')
                    ->select('*')
                   // ->where('estatus','=','1')
                    ->where('id','=', $idAnalisis)
                    ->get();

            foreach ($searchAnalisis as $analisis) {
                    $montoAnalisis = $analisis->costlab;
                    $nameAnalisis = $analisis->name;
                }



        $atenciolab = AtencionProfesionalesPaqueteLab::findOrFail($id);
        $atenciolab->pagadolab = 1;
        $atenciolab->update();

       $debitos = new Debitos;
       $debitos->descripcion =$nameAnalisis;
       $debitos->monto     =$montoAnalisis;
       $debitos->origen     ='LABORATORIOS POR PAGAR';
       $debitos->id_empresa     =$usuarioEmp;
       $debitos->id_sucursal     =$usuarioSuc;
       $debitos->save();



   }


        return redirect()->route('admin.labporpagar.index');
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
