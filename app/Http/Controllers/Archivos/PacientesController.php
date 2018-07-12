<?php

namespace App\Http\Controllers\Archivos;

use App\Pacientes;
use App\Provincia;
use App\Distrito;
use App\EdoCivil;
use App\GradoInstruccion;
use App\HistoriasClinicas;
use DB;
use Silber\Bouncer\Database\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Archivos\StorePacientesRequest;
use App\Http\Requests\Archivos\UpdatePacientesRequest;

class PacientesController extends Controller
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

        $pacientes = Pacientes::with('roles')->get();

        $pacientes = DB::table('pacientes as a')
        ->select('a.id','a.nombres','a.apellidos','a.dni','a.provincia','a.distrito','a.direccion','a.gradoinstruccion','a.telefono','a.ocupacion','a.edocivil','a.fechanac','a.created_at','b.historia')
        ->join('historias_clinicas as b','a.id','b.id_paciente')
        ->where('a.estatus','=','1')
        ->orderby('a.created_at','desc')
        ->paginate(10);

        $provincia= Provincia::with('nombre');
        $distrito = Distrito::with('nombre');
        $edocivil = EdoCivil::with('nombre');
        $gradoinstruccion = GradoInstruccion::with('nombre');

        return view('archivos.pacientes.index', compact('pacientes','provincia','distrito','edocivil','gradoinstruccion'));
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
       $provincia = Provincia::get()->pluck('nombre', 'nombre');
       $distrito = Distrito::get()->pluck('nombre', 'nombre');
       $edocivil = EdoCivil::get()->pluck('nombre', 'nombre');
       $gradoinstruccion = GradoInstruccion::get()->pluck('nombre', 'nombre');


        return view('archivos.pacientes.create', compact('provincia','distrito','edocivil','gradoinstruccion'));
    }



    public function store (StorePacientesRequest $request)
    {
        if (! Gate::allows('users_manage')) {
            return abort(401);
        }

       $pacientes = new Pacientes;
       $pacientes->dni =$request->dni;
       $pacientes->nombres     =$request->nombres;
       $pacientes->apellidos     =$request->apellidos;
       $pacientes->direccion     =$request->direccion;
       $pacientes->provincia     =$request->provincia;
       $pacientes->distrito     =$request->distrito;
       $pacientes->telefono     =$request->telefono;
       $pacientes->fechanac     =$request->fechanac;
       $pacientes->gradoinstruccion     =$request->gradoinstruccion;
       $pacientes->ocupacion     =$request->ocupacion;
       $pacientes->edocivil     =$request->edocivil;
       $pacientes->save();

       $historiaclinica=str_pad(($pacientes->id),4, "0", STR_PAD_LEFT);

       $historia = new HistoriasClinicas;
       $historia->id_paciente =$pacientes->id;
       $historia->historia    =$historiaclinica;
       $historia->save();

    
        return redirect()->route('admin.pacientes.index');
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
