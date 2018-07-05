<?php

namespace App\Http\Controllers\Archivos;

use App\Laboratorios;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Archivos\StorelaboratoriosRequest;
use App\Http\Requests\Archivos\UpdateLaboratoriosRequest;

class LaboratoriosController extends Controller
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

        $laboratorio = Laboratorios::with('roles')->get();

        return view('archivos.laboratorios.index', compact('laboratorio'));
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

        return view('archivos.laboratorios.create');
    }

    /**
     * Store a newly created User in storage.
     *
     * @param  \App\Http\Requests\StoreUsersRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorelaboratoriosRequest $request)
    {
        if (! Gate::allows('users_manage')) {
            return abort(401);
        }
        $laboratorio = Laboratorios::create($request->all());

        return redirect()->route('admin.laboratorios.index');
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

        $laboratorio = Laboratorios::findOrFail($id);

        return view('archivos.laboratorios.edit', compact('laboratorio'));
    }

    /**
     * Update User in storage.
     *
     * @param  \App\Http\Requests\UpdateUsersRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateLaboratoriosRequest $request, $id)
    {
        if (! Gate::allows('users_manage')) {
            return abort(401);
        }
        $laboratorio = Laboratorios::findOrFail($id);
        $laboratorio->update($request->all());
       
        return redirect()->route('admin.laboratorios.index');
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
        $laboratorio = Laboratorios::findOrFail($id);
        $laboratorio->delete();

        return redirect()->route('admin.laboratorios.index');
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
            $entries = User::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }

}
