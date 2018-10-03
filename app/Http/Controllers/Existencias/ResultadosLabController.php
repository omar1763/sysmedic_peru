<?php

namespace App\Http\Controllers\Existencias;
use App\AtencionLaboratorio;
use App\AtencionServicios;
use App\AtencionProfesionalesServicio;
use App\AtencionProfesionalesLaboratorio;
use App\Locales;
use App\Empresas;
use App\RedactarResultadosLab;
use App\AtencionDetalle;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\Movimientos\StoreResultadosRequest;
use App\Http\Requests\Movimientos\UpdateResultadosRequest;

class ResultadosLabController extends Controller
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

                

                 $laboratorios = DB::table('atencion_profesionales_laboratorios as a')
                ->select('a.id','a.id_atencion','a.id_laboratorio','a.pagado','a.id_empresa','a.id_profesional','a.id_sucursal','a.created_at','d.name as detalleservicio','e.id_paciente','f.nombres','f.apellidos','a.status_redactar_resultados','g.name','g.apellidos as ape')
                ->join('empresas as b','a.id_empresa','b.id')
                ->join('locales as c','a.id_sucursal','c.id')
                ->join('analises as d','a.id_laboratorio','d.id')
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


                 
        } else {

               $laboratorios = DB::table('atencion_profesionales_laboratorios as a')
                ->select('a.id','a.id_atencion','a.id_laboratorio','a.pagado','a.id_empresa','a.id_sucursal','a.created_at','d.name as detalleservicio','e.id_paciente','f.nombres','f.apellidos','a.status_redactar_resultados','g.name','g.apellidos as ape')
                ->join('empresas as b','a.id_empresa','b.id')
                ->join('locales as c','a.id_sucursal','c.id')
                ->join('analises as d','a.id_laboratorio','d.id')
                ->join('atencion_detalles as e','a.id_atencion','e.id_atencion')
                ->join('pacientes as f','f.id','e.id_paciente')
               ->join('profesionales as g','g.id','a.id_profesional')
                ->where('a.status_redactar_resultados','=',0)
                ->where('a.id_empresa','=', $usuarioEmp)
                ->where('a.id_sucursal','=', $usuarioSuc)
                //->where('a.created_at','=', $f1)
                ->whereDate('a.created_at', '=', Carbon::now()->format('Y-m-d'))
                ->orderby('a.created_at','desc')
                ->get();
        }


        return view('existencias.resultadoslab.index', compact('laboratorios'));
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
        if (RedactarResultadosLab::where('id_atencion_lab', '=', $_GET['id'])->exists()) {
            $modelRR=RedactarResultadosLab::where('id_atencion_lab', '=', $_GET['id'])->first();
            $comentario=$modelRR->descripcion;
            $exists=true;

        }
        else{
            $exists=false;
            $comentario='';

        }

            $laboratorios = DB::table('atencion_profesionales_laboratorios as a')
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
                ->orderby('a.created_at','desc')
                ->get();

        return view('existencias.resultadoslab.create',compact('id','exists','comentario','laboratorios'));
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

     
        $atencionlab = AtencionProfesionalesLaboratorio::findOrFail($_POST['id']);     
        $atencionlab->status_redactar_resultados=1;
        $atencionlab->update();

        $redactarresultados = new RedactarResultadosLab();
        $redactarresultados->id_atencion_lab  =$_POST['id'];
        $redactarresultados->descripcion   =$request->editor1;
        $redactarresultados->tipo= 2;
        $redactarresultados->save();

        return redirect()->route('admin.resultadoslab.index');
    }


}
