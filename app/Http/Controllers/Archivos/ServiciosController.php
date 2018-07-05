<?php

namespace App\Http\Controllers\Archivos;

use App\Servicios;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Archivos\StoreServiciosRequest;
use App\Http\Requests\Archivos\UpdateServiciosRequest;

class ServiciosController extends Controller
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

        $servicios = Servicios::with('roles')->get();

        return view('archivos.servicios.index', compact('servicios'));
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

        return view('archivos.servicios.create');
    }

    /**
     * Store a newly created User in storage.
     *
     * @param  \App\Http\Requests\StoreUsersRequest  $request
     * @return \Illuminate\Http\Response
     */
    
    public function store(StoreServiciosRequest $request)
    {
        if (! Gate::allows('users_manage')) {
            return abort(401);
        }
        $servicios = Servicios::create($request->all());

        return redirect()->route('admin.servicios.index');
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

        $servicios = Servicios::findOrFail($id);

        return view('archivos.servicios.edit', compact('servicios'));
    }

    /**
     * Update User in storage.
     *
     * @param  \App\Http\Requests\UpdateUsersRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateServiciosRequest $request, $id)
    {
        if (! Gate::allows('users_manage')) {
            return abort(401);
        }
        $servicios = Servicios::findOrFail($id);
        $servicios->update($request->all());
       
        return redirect()->route('admin.servicios.index');
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
        $servicios = Servicios::findOrFail($id);
        $servicios->delete();

        return redirect()->route('admin.servicios.index');
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
            $entries = Servicios::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }

}
