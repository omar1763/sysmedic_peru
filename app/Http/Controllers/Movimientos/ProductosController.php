<?php

namespace App\Http\Controllers\Movimientos;

use App\Productos;
use App\Medidas;
use App\Empresas;
use App\Locales;
use DB;
use Silber\Bouncer\Database\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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


         $productos = DB::table('productos as a')
        ->select('a.id','a.name','a.medida','a.cantidad','a.precio','a.updated_at','b.nombre','c.nombres','a.id_empresa','a.id_sucursal')
        ->join('empresas as b','a.id_empresa','b.id')
        ->join('locales as c','a.id_sucursal','c.id')
        ->where('a.id_empresa','=', $usuarioEmp)
        ->where('a.id_sucursal','=', $usuarioSuc)
        ->orderby('a.created_at','desc')
        ->paginate(10000);

        $medida = Medidas::with('nombre');

        return view('movimientos.productos.index', compact('productos','medida'));
    }

     public function index2()
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


         $productos = DB::table('productos as a')
        ->select('a.id','a.name','a.medida','a.cantidad','a.precio','a.updated_at','b.nombre','c.nombres','a.id_empresa','a.id_sucursal')
        ->join('empresas as b','a.id_empresa','b.id')
        ->join('locales as c','a.id_sucursal','c.id')
        ->where('a.id_empresa','=', $usuarioEmp)
        ->where('a.id_sucursal','=', $usuarioSuc)
        ->orderby('a.created_at','desc')
        ->paginate(10000);

        $medida = Medidas::with('nombre');

        return view('movimientos.productos.index2', compact('productos','medida'));
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

       $productos = new Productos;
       $productos->name =$request->name;
       $productos->medida     =$request->medida;
       $productos->cantidad     =$request->cantidad;
       $productos->precio     =$request->precio;
       $productos->id_empresa     =$usuarioEmp;
       $productos->id_sucursal     =$usuarioSuc;
       $productos->save();

    
        return redirect()->route('admin.productos.index2');
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

       $productos = Productos::findOrFail($id);
       $productos->name =$request->name;
       $productos->medida     =$request->medida;
       $productos->cantidad     =$request->cantidad;
       $productos->precio     =$request->precio;
       $productos->id_empresa     =$usuarioEmp;
       $productos->id_sucursal     =$usuarioSuc;
       $productos->update();
      
        return redirect()->route('admin.productos.index2');
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

        return redirect()->route('admin.productos.index2');
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
