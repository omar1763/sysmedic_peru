<?php

namespace App\Http\Controllers\Existencias;
use App\AtencionLaboratorio;
use App\AtencionServicios;
use App\AtencionProfesionalesServicio;
use App\AtencionProfesionalesLaboratorio;
use App\Locales;
use App\Empresas;
use App\RedactarResultados;
use App\AtencionDetalle;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\Movimientos\StoreResultadosRequest;
use App\Http\Requests\Movimientos\UpdateResultadosRequest;

class ResultadosController extends Controller
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
                    ->get();

            foreach ($searchUsuarioID as $usuario) {
                    $usuarioEmp = $usuario->id_empresa;
                    $usuarioSuc = $usuario->id_sucursal;
                }
         

                $f1 = date('YYYY-m-d');

                if(! is_null($request->fecha)) {
                    $f1 = $request->fecha;

                $servicios = DB::table('atencion_profesionales_servicios as a')
                ->select('a.id','a.id_atencion','a.id_servicio','a.pagado','a.id_profesional','a.id_empresa','a.id_sucursal','a.created_at','d.detalle as detalleservicio','e.id_paciente','f.nombres','f.apellidos','a.status_redactar_resultados','g.name','g.apellidos as ape')
                ->join('empresas as b','a.id_empresa','b.id')
                ->join('locales as c','a.id_sucursal','c.id')
                ->join('servicios as d','a.id_servicio','d.id')
                ->join('atencion_detalles as e','a.id_atencion','e.id_atencion')
                ->join('pacientes as f','f.id','e.id_paciente')
                ->join('profesionales as g','g.id','a.id_profesional')
                ->where('a.status_redactar_resultados','=',0)
                ->where('a.id_empresa','=', $usuarioEmp)
                ->where('a.id_sucursal','=', $usuarioSuc)
                ->where('a.created_at','=', $f1)
                    //->whereDate('a.created_at', '=', Carbon::now()->format('Y-m-d'))
                ->orderby('a.created_at','desc')
                ->get();
                

                /*  $servicios = DB::table('atencion_profesionales_laboratorios as a')
                ->select('a.id','a.id_atencion','a.id_laboratorio','a.pagado','a.id_empresa','a.id_sucursal','a.created_at','d.name as detalleservicio','e.id_paciente','f.nombres','f.apellidos','a.status_redactar_resultados')
                ->join('empresas as b','a.id_empresa','b.id')
                ->join('locales as c','a.id_sucursal','c.id')
                ->join('analises as d','a.id_laboratorio','d.id')
                ->join('atencion_detalles as e','a.id_atencion','e.id_atencion')
                ->join('pacientes as f','f.id','e.id_paciente')
                ->where('a.status_redactar_resultados','=',0)
                ->where('a.id_empresa','=', $usuarioEmp)
                ->where('a.id_sucursal','=', $usuarioSuc)
                ->where('a.created_at','=', $f1)
                    //->whereDate('a.created_at', '=', Carbon::now()->format('Y-m-d'))
                ->orderby('a.created_at','desc')
                ->union($servicios1)
                ->get();*/


                 
        } else {

               $servicios = DB::table('atencion_profesionales_servicios as a')
                ->select('a.id','a.id_atencion','a.id_servicio','a.pagado','a.id_profesional','a.id_empresa','a.id_sucursal','a.created_at','d.detalle as detalleservicio','e.id_paciente','f.nombres','f.apellidos','a.status_redactar_resultados','g.name','g.apellidos as ape')
                ->join('empresas as b','a.id_empresa','b.id')
                ->join('locales as c','a.id_sucursal','c.id')
                ->join('servicios as d','a.id_servicio','d.id')
                ->join('atencion_detalles as e','a.id_atencion','e.id_atencion')
                ->join('pacientes as f','f.id','e.id_paciente')
                ->join('profesionales as g','g.id','a.id_profesional')
                ->where('a.status_redactar_resultados','=',0)
                ->where('a.id_empresa','=', $usuarioEmp)
                ->where('a.id_sucursal','=', $usuarioSuc)
               // ->where('a.created_at','=', $f1)
                ->whereDate('a.created_at', '=', Carbon::now()->format('Y-m-d'))
                ->orderby('a.created_at','desc')
                ->get();
                

               /**   $servicios = DB::table('atencion_profesionales_laboratorios as a')
                ->select('a.id','a.id_atencion','a.id_laboratorio','a.pagado','a.id_empresa','a.id_sucursal','a.created_at','d.name as detalleservicio','e.id_paciente','f.nombres','f.apellidos','a.status_redactar_resultados')
                ->join('empresas as b','a.id_empresa','b.id')
                ->join('locales as c','a.id_sucursal','c.id')
                ->join('analises as d','a.id_laboratorio','d.id')
                ->join('atencion_detalles as e','a.id_atencion','e.id_atencion')
                ->join('pacientes as f','f.id','e.id_paciente')
                ->where('a.status_redactar_resultados','=',0)
                ->where('a.id_empresa','=', $usuarioEmp)
                ->where('a.id_sucursal','=', $usuarioSuc)
                //->where('a.created_at','=', $f1)
                ->whereDate('a.created_at', '=', Carbon::now()->format('Y-m-d'))
                ->orderby('a.created_at','desc')
                ->union($servicios1)
                ->get();*/
        }


        return view('existencias.resultados.index', compact('servicios'));
    }

    /**
     * Show the form for creating new User.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
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
                
        $id=$_GET['id'];
        $exists;
        $comentario;
        if (RedactarResultados::where('id_atencion_servicio', '=', $_GET['id'])->exists()) {
            $modelRR=RedactarResultados::where('id_atencion_servicio', '=', $_GET['id'])->first();
            $comentario=$modelRR->descripcion;
            $exists=true;

        }
        else{
            $exists=false;
            $comentario='';

        }

          $servicios = DB::table('atencion_profesionales_servicios as a')
                ->select('a.id','a.id_atencion','a.id_servicio','a.pagado','a.id_empresa','a.id_sucursal','a.created_at','d.detalle as detalleservicio','e.id_paciente','f.nombres','f.apellidos','a.status_redactar_resultados')
                ->join('empresas as b','a.id_empresa','b.id')
                ->join('locales as c','a.id_sucursal','c.id')
                ->join('servicios as d','a.id_servicio','d.id')
                ->join('atencion_detalles as e','a.id_atencion','e.id_atencion')
                ->join('pacientes as f','f.id','e.id_paciente')
                ->where('a.id_empresa','=', $usuarioEmp)
                ->where('a.id_sucursal','=', $usuarioSuc)
                ->orderby('a.created_at','desc')
                ->paginate(100);

        return view('existencias.resultados.create',compact('id','exists','comentario','servicios'));
    }

    /**Ll
     * Store a newly created User in storage.
     *
     * @param  \App\Http\Requests\StoreUsersRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreResultadosRequest $request)
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

     
        $atencionservicio = AtencionProfesionalesServicio::findOrFail($_POST['id']);     
        $atencionservicio->status_redactar_resultados=1;
        $atencionservicio->update();

        $redactarresultados = new RedactarResultados();
        $redactarresultados->id_atencion_servicio  =$_POST['id'];
        $redactarresultados->descripcion   =$request->editor1;
        $redactarresultados->tipo= 1;
        $redactarresultados->save();

        return redirect()->route('admin.resultados.index');
    }


}
