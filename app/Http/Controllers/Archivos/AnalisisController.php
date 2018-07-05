<?php

namespace App\Http\Controllers\Archivos;

use App\Analisis;
use App\Laboratorios;
use Silber\Bouncer\Database\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Archivos\StoreAnalisisRequest;
use App\Http\Requests\Archivos\UpdateAnalisisRequest;

class AnalisisController extends Controller
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

        $analisis = Analisis::with('roles')->get();
        $laboratorio = Laboratorios::with('centro');

        return view('archivos.analisis.index', compact('analisis','laboratorio'));
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
  
       $laboratorio = Laboratorios::get()->pluck('nombre', 'nombre');

        return view('archivos.analisis.create', compact('laboratorio'));
    }

    /**
     * Store a newly created User in storage.
     *
     * @param  \App\Http\Requests\StoreUsersRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAnalisisRequest $request)
    {
        if (! Gate::allows('users_manage')) {
            return abort(401);
        }

        $analisis = Analisis::create($request->all());

    
       

        return redirect()->route('admin.analisis.index');
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
     

        $analisis = Analisis::findOrFail($id);
        $laboratorio = Laboratorios::get()->pluck('nombre', 'nombre');
      

        return view('archivos.analisis.edit', compact('analisis', 'laboratorio'));
    }

    /**
     * Update User in storage.
     *
     * @param  \App\Http\Requests\UpdateUsersRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAnalisisRequest $request, $id)
    {
        if (! Gate::allows('users_manage')) {
            return abort(401);
        }
        $analisis = Analisis::findOrFail($id);
        $analisis->update($request->all());
      
        return redirect()->route('admin.analisis.index');
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
        $analisis = Analisis::findOrFail($id);
        $analisis->delete();

        return redirect()->route('admin.analisis.index');
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
            $entries = Analisis::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }

}
