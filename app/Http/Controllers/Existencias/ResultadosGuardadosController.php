<?php

namespace App\Http\Controllers\Existencias;
use App\AtencionLaboratorio;
use App\AtencionServicios;
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

class ResultadosGuardadosController extends Controller
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
    	$f2 = date('YYYY-m-d');

    	$f1 = $request->fecha;
    	$f2 = $request->fecha2;

    	$servicios = DB::table('atencion_profesionales_servicios as a')
    	->select('a.id','a.id_atencion','a.id_servicio','a.pagado','a.id_empresa','a.id_profesional','a.id_sucursal','a.created_at','d.detalle as detalleservicio','e.id_paciente','f.nombres','f.apellidos','a.status_redactar_resultados','g.name','g.apellidos as ape')
    	->join('empresas as b','a.id_empresa','b.id')
    	->join('locales as c','a.id_sucursal','c.id')
    	->join('servicios as d','a.id_servicio','d.id')
    	->join('atencion_detalles as e','a.id_atencion','e.id_atencion')
    	->join('pacientes as f','f.id','e.id_paciente')
        ->join('profesionales as g','g.id','a.id_profesional')
    	->where('a.status_redactar_resultados','=',1)
    	->where('a.id_empresa','=', $usuarioEmp)
    	->where('a.id_sucursal','=', $usuarioSuc)
    	->whereBetween('a.created_at', [$f1, $f2])
    	->orderby('a.created_at','desc')
    	->paginate(1000);


    	return view('existencias.resultadosguardados.index', compact('servicios'));
    }

    /**
     * Show the form for creating new User.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
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
        return view('existencias.resultados.create',compact('id','exists','comentario'));
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

        $atencionservicio = AtencionProfesionalesServicios::findOrFail($_POST['id']);     
        $atencionservicio->status_redactar_resultados=1;
        $atencionservicio->update();
        $redactarresultados = new RedactarResultados();
        $redactarresultados->id_atencion_servicio  =$_POST['id'];
        $redactarresultados->descripcion   =$request->editor1;
       
       $redactarresultados->save();
//dd($_POST);

        return redirect()->route('admin.resultados.index');
    }


    /**
     * Show the form for editing User.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('users_manage')) {
            return abort(401);
        }

        $gastos = Gastos::findOrFail($id);

        return view('existencias.gastos.edit', compact('gastos'));
    }

    /**
     * Update User in storage.
     *
     * @param  \App\Http\Requests\UpdateUsersRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateGastosRequest $request, $id)
    {
        if (! Gate::allows('users_manage')) {
            return abort(401);
        }
        $gastos = Gastos::findOrFail($id);
        $gastos->update($request->all());
       
        return redirect()->route('admin.gastos.index');
    }

    /**
     * Remove User from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('users_manage')) {
            return abort(401);
        }
        $gastos = Gastos::findOrFail($id);
        $gastos->delete();

        return redirect()->route('admin.gastos.index');
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
