<?php

namespace App\Http\Controllers\Movimientos;

use App\Productos;
use App\Medidas;
use Silber\Bouncer\Database\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Movimientos\StoreProductosRequest;
use App\Http\Requests\Movimientos\UpdateProductosRequest;

class ProductosController extends Controller
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

        $productos = Productos::with('roles')->get();
        $medida = Medidas::with('nombre');

        return view('movimientos.productos.index', compact('productos','medida'));
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
       $medida = Medidas::get()->pluck('nombre', 'nombre');


        return view('movimientos.productos.create', compact('medida'));
    }

    /**
     * Store a newly created User in storage.
     *
     * @param  \App\Http\Requests\StoreUsersRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductosRequest $request)
    {
        if (! Gate::allows('users_manage')) {
            return abort(401);
        }

        $productos = Productos::create($request->all());

    
        return redirect()->route('admin.productos.create');
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
     

        $productos = Productos::findOrFail($id);
        $medida = Medidas::get()->pluck('nombre', 'nombre');

        return view('movimientos.productos.edit', compact('productos', 'medida'));
    }

    /**
     * Update User in storage.
     *
     * @param  \App\Http\Requests\UpdateUsersRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductosRequest $request, $id)
    {
        if (! Gate::allows('users_manage')) {
            return abort(401);
        }
        $productos = Productos::findOrFail($id);
        $productos->update($request->all());
      
        return redirect()->route('admin.productos.index');
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
        $productos = Productos::findOrFail($id);
        $productos->delete();

        return redirect()->route('admin.productos.index');
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
            $entries = Productos::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }

}
