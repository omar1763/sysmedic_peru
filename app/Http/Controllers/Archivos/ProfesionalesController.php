<?php

namespace App\Http\Controllers\Archivos;

use App\Profesionales;
use App\Centros;
use App\Especialidad;
use Silber\Bouncer\Database\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Archivos\StoreProfesionalesRequest;
use App\Http\Requests\Archivos\UpdateProfesionalesRequest;

class ProfesionalesController extends Controller
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

        $profesionales = Profesionales::with('roles')->get();
        $centro = Centros::with('centro');

        return view('archivos.profesionales.index', compact('profesionales','centro'));
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
       $centro = Centros::get()->pluck('nombre', 'nombre');
       $especialidad = Especialidad::get()->pluck('nombre', 'nombre');


        return view('archivos.profesionales.create', compact('centro','especialidad'));
    }

    /**
     * Store a newly created User in storage.
     *
     * @param  \App\Http\Requests\StoreUsersRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProfesionalesRequest $request)
    {
        if (! Gate::allows('users_manage')) {
            return abort(401);
        }

        $profesionales = Profesionales::create($request->all());

    
       

        return redirect()->route('admin.profesionales.index');
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
     

        $profesionales = Profesionales::findOrFail($id);
        $centro = Centros::get()->pluck('nombre', 'nombre');
        $especialidad = Especialidad::get()->pluck('nombre', 'nombre');

        return view('archivos.profesionales.edit', compact('profesionales', 'roles','centro','especialidad'));
    }

    /**
     * Update User in storage.
     *
     * @param  \App\Http\Requests\UpdateUsersRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProfesionalesRequest $request, $id)
    {
        if (! Gate::allows('users_manage')) {
            return abort(401);
        }
        $profesionales = Profesionales::findOrFail($id);
        $profesionales->update($request->all());
      
        return redirect()->route('admin.profesionales.index');
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
        $profesionales = Profesionales::findOrFail($id);
        $profesionales->delete();

        return redirect()->route('admin.profesionales.index');
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
            $entries = Profesionales::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }

}
