<?php

namespace App\Http\Controllers\Existencias;
use App\AtencionLaboratorio;
use App\AtencionServicios;
use App\AtencionProfesionalesServicio;
use App\AtencionProfesionalesLaboratorio;
use App\AtencionProfesionalesPaquete;
use App\AtencionProfesionalesPaqueteLab;
use App\Locales;
use App\Empresas;
use App\RedactarResultadosPaqServ;
use App\RedactarResultadosPaqLab;
use App\AtencionDetalle;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\Movimientos\StoreResultadosRequest;
use App\Http\Requests\Movimientos\UpdateResultadosRequest;

if (version_compare(PHP_VERSION, '7.2.0', '>=')) { // Ignores notices and reports all other kinds... and warnings error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING); // error_reporting(E_ALL ^ E_WARNING); // Maybe this is enough } 


class ResultadosPaqServController extends Controller
{
    


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

         

                 $paquetes = DB::table('atencion_profesionales_paquetes as a')
                ->select('a.id', 'a.id_atencion', 'a.id_paquete','a.id_servicio', 'a.pagado','a.id_profesional', 'a.porcentajepaq as porcentaje',
                    'a.recibo', 'a.created_at as fecha','a.status_redactar_resultados','a.id_profesional', 'b.costo','b.id_paciente','b.costoa', 'f.name as nombres',
                    'f.apellidos', 'b.origen', 'p.nombres as pnombres', 'p.apellidos as papellidos','c.name as detalle','c.costo as precio','i.detalle as detalle1')
                ->join('profesionales as f','f.id','a.id_profesional')
                ->join('atencion_detalles as b','a.id_atencion','b.id_atencion')
                ->join('pacientes as p','p.id','b.id_paciente')
                ->join('paquetes as c','c.id','a.id_paquete')
                ->join('servicios as i','i.id','a.id_servicio')
                ->join('profesionales as g','g.id','a.id_profesional')
                ->where('a.status_redactar_resultados','=',0)
                ->where('a.id_empresa','=', $usuarioEmp)
                ->where('a.id_sucursal','=', $usuarioSuc)
                ->orderby('a.id_atencion','DESC')
                ->where('a.created_at','=', $f1)
                ->get();



            } else {



                 $paquetes = DB::table('atencion_profesionales_paquetes as a')
                ->select('a.id', 'a.id_atencion', 'a.id_paquete','a.id_servicio', 'a.pagado', 'a.porcentajepaq as porcentaje',
                    'a.recibo', 'a.created_at as fecha','a.status_redactar_resultados','a.id_profesional', 'b.costo','b.id_paciente','b.costoa', 'f.name as nombres',
                    'f.apellidos', 'b.origen', 'p.nombres as pnombres', 'p.apellidos as papellidos','c.name as detalle','c.costo as precio','i.detalle as detalle1')
                ->join('profesionales as f','f.id','a.id_profesional')
                ->join('atencion_detalles as b','a.id_atencion','b.id_atencion')
                ->join('pacientes as p','p.id','b.id_paciente')
                ->join('paquetes as c','c.id','a.id_paquete')
                ->join('servicios as i','i.id','a.id_servicio')
                ->where('a.status_redactar_resultados','=',0)
                ->where('a.id_empresa','=', $usuarioEmp)
                ->where('a.id_sucursal','=', $usuarioSuc)
                ->orderby('a.id_atencion','DESC')
                ->whereDate('a.created_at', '=', Carbon::now()->format('Y-m-d'))
                ->get();
               



         }


        return view('existencias.resultadospaqserv.index', compact('paquetes'));
    }

   
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
        if (RedactarResultadosPaqServ::where('id_atencion_ser', '=', $_GET['id'])->exists()) {
            $modelRR=RedactarResultadosPaqServ::where('id_atencion_ser', '=', $_GET['id'])->first();
            $comentario=$modelRR->descripcion;
            $exists=true;

        }
        else{
            $exists=false;
            $comentario='';

        }


                 
                 $paquetes = DB::table('atencion_profesionales_paquetes as a')
                ->select('a.id', 'a.id_atencion', 'a.id_paquete','a.id_servicio', 'a.pagado', 'a.porcentajepaq as porcentaje',
                    'a.recibo', 'a.created_at as fecha','a.status_redactar_resultados','a.id_profesional', 'b.costo','b.id_paciente','b.costoa', 'f.name as nombres',
                    'f.apellidos', 'b.origen', 'p.nombres as pnombres', 'p.apellidos as papellidos','c.name as detalle','c.costo as precio','i.detalle as detalle1')
                ->join('profesionales as f','f.id','a.id_profesional')
                ->join('atencion_detalles as b','a.id_atencion','b.id_atencion')
                ->join('pacientes as p','p.id','b.id_paciente')
                ->join('paquetes as c','c.id','a.id_paquete')
                ->join('servicios as i','i.id','a.id_servicio')
                ->where('a.status_redactar_resultados','=',0)
                ->where('a.id_empresa','=', $usuarioEmp)
                ->where('a.id_sucursal','=', $usuarioSuc)
                ->orderby('a.id_atencion','DESC')
                ->get();

        return view('existencias.resultadospaqserv.create',compact('id','exists','comentario','paquetes'));
    }

  
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

     
        $atencionlab = AtencionProfesionalesPaquete::findOrFail($_POST['id']);     
        $atencionlab->status_redactar_resultados=1;
        $atencionlab->update();

        $redactarresultados = new RedactarResultadosPaqServ();
        $redactarresultados->id_atencion_ser  =$_POST['id'];
        $redactarresultados->descripcion   =$request->editor1;
        $redactarresultados->tipo= 3;
        $redactarresultados->save();

        return redirect()->route('admin.resultadospaqserv.index');
    }

}
}
