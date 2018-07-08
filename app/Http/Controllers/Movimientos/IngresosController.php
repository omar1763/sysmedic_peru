<?php

namespace App\Http\Controllers\Movimientos;

use App\Productos;
use App\Ingresos;
use Silber\Bouncer\Database\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Movimientos\StoreIngresosRequest;
use App\Http\Requests\Movimientos\UpdateIngresosRequest;

class IngresosController extends Controller
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

        $ingresos = Ingresos::with('roles')->get();
        $productos = Productos::with('nombre');

        return view('movimientos.ingresos.index', compact('productos','ingresos'));
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
       $producto = Productos::get()->pluck('nombre', 'nombre');


        return view('movimientos.ingresos.create', compact('producto'));
    }

    /**
     * Store a newly created User in storage.
     *
     * @param  \App\Http\Requests\StoreUsersRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreIngresosRequest $request)
    {
        if (! Gate::allows('users_manage')) {
            return abort(401);
        }


         
        $productos =Productos::all();

        foreach ($productos as $producto) {
                    $nombreprod = $producto->nombre;
                    $cantidadprod = $producto->cantidad;
                }

       $ingresos = new Ingresos;
       $ingresos->producto =$request->producto;
       $ingresos->cantidad     =$request->cantidad;
       $ingresos->fechaingreso     =$request->fechaingreso;
       $ingresos->save();

      
       $productos=Productos::where('nombre', '=' , $nombreprod)->get()->first();
       $productos->cantidad=$cantidadprod + $ingresos->cantidad;
       $productos->update();


    
        return redirect()->route('admin.ingresos.index');
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
     

        $ingresos = Ingresos::findOrFail($id);
        $producto = Productos::get()->pluck('nombre', 'nombre');

        return view('movimientos.ingresos.edit', compact('producto', 'ingresos'));
    }

    /**
     * Update User in storage.
     *
     * @param  \App\Http\Requests\UpdateUsersRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateIngresosRequest $request, $id)
    {
        if (! Gate::allows('users_manage')) {
            return abort(401);
        }

       
        $productos =Productos::all();

        foreach ($productos as $producto) {
                    $nombreprod = $producto->nombre;
                    $cantidadprod = $producto->cantidad;
                }


        $ingresos = Ingresos::findOrFail($id);
        $ingresos->update($request->all());

        $productos=Productos::where('nombre', '=' , $nombreprod)->get()->first();
        $productos->cantidad=$cantidadprod + 10000;
        $productos->update();

      
        return redirect()->route('admin.ingresos.index');
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
        $ingresos = Ingresos::findOrFail($id);
        $ingresos->delete();

        return redirect()->route('admin.ingresos.index');
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
            $ingresos = Ingresos::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }

}
