<?php

namespace App\Http\Controllers\Existencias;
use App\AtencionLaboratorio;
use App\AtencionServicios;
use App\Locales;
use App\Empresas;
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
         
         
                      
    
                  $servicios = DB::table('atencion_servicios as a')
                    ->select('a.id','a.id_atencion','a.id_servicio','a.pagado','a.id_empresa','a.id_sucursal','a.created_at','d.detalle as detalleservicio','e.id_paciente','f.nombres','f.apellidos')
                    ->join('empresas as b','a.id_empresa','b.id')
                    ->join('locales as c','a.id_sucursal','c.id')
                    ->join('servicios as d','a.id_servicio','d.id')
                    ->join('atencion_detalles as e','a.id_atencion','e.id_atencion')
                    ->join('pacientes as f','f.id','e.id_paciente')
                    ->where('a.id_empresa','=', $usuarioEmp)
                    ->where('a.id_sucursal','=', $usuarioSuc)
                   // ->where('a.created_at','=', $f1)
                    //->whereDate('a.created_at', '=', Carbon::now()->format('Y-m-d'))
                    ->orderby('a.created_at','desc')
                    ->paginate(500);
       


        return view('existencias.resultados.index', compact('servicios'));
    }

    /**
     * Show the form for creating new User.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('users_manage')) {
            return abort(401);
        }

        return view('existencias.resultados.create');
    }

    /**Ll
     * Store a newly created User in storage.
     *
     * @param  \App\Http\Requests\StoreUsersRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreResultadosRequest $request)
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
