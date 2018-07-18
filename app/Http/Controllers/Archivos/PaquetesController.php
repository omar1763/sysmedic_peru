<?php

namespace App\Http\Controllers\Archivos;

use App\Paquetes;
use App\PaquetesServ;
use App\Servicios;
use App\Empresas;
use App\Locales;
use DB;
use Silber\Bouncer\Database\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Archivos\StorePaquetesRequest;
use App\Http\Requests\Archivos\UpdatePaquetesRequest;

class PaquetesController extends Controller
{
    /**
     * Display a listing of User.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
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

        $paquetes = DB::table('paquetes as a')
        ->select('a.id','a.name','a.costo','a.id_empresa','a.id_sucursal')
        ->where('a.id_empresa','=',$usuarioEmp)
        ->where('a.id_sucursal','=',$usuarioSuc)
       // ->where('a.estatus','=','1')
        ->orderby('a.created_at','desc')
        ->paginate(10);

       

        return view('archivos.paquetes.index', compact('paquetes'));
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
       $servicio = Servicios::get()->pluck('detalle');
    
        return view('archivos.paquetes.create', compact('servicio'));
    }



    public function store (StorePaquetesRequest $request)
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

       $paquetes = new Paquetes;
       $paquetes->name =$request->name;
       $paquetes->costo     =$request->costo;
       $paquetes->id_empresa     =$usuarioEmp;
       $paquetes->id_sucursal     =$usuarioSuc;
       $paquetes->save();



       $paquetesserv = new PaquetesServ;
       $paquetesserv->id_paquete =$paquetes->id;
       $paquetesserv->id_servicio    =$paquetes->id;
       $paquetesserv->save();

    
        return redirect()->route('admin.paquetes.index');
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
     

       $pacientes = Pacientes::findOrFail($id);
       $provincia = Provincia::get()->pluck('nombre', 'nombre');
       $distrito = Distrito::get()->pluck('nombre', 'nombre');
       $edocivil = EdoCivil::get()->pluck('nombre', 'nombre');
       $gradoinstruccion = GradoInstruccion::get()->pluck('nombre', 'nombre');

        return view('archivos.pacientes.edit', compact('pacientes', 'provincia','distrito','edocivil','gradoinstruccion'));
    }

    /**
     * Update User in storage.
     *
     * @param  \App\Http\Requests\UpdateUsersRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePacientesRequest $request, $id)
    {
        if (! Gate::allows('users_manage')) {
            return abort(401);
        }
        $pacientes = Pacientes::findOrFail($id);
        $pacientes->update($request->all());
      
        return redirect()->route('admin.pacientes.index');
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
        $pacientes = Pacientes::findOrFail($id);
        $pacientes->delete();

        return redirect()->route('admin.pacientes.index');
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
            $entries = Pacientes::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }

}
