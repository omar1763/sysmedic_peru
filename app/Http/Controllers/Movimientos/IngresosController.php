<?php

namespace App\Http\Controllers\Movimientos;

use App\Productos;
use App\Ingresos;
use App\Empresas;
use App\Locales;
use DB;
use Illuminate\Support\Facades\Auth;
use Silber\Bouncer\Database\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Movimientos\StoreIngresosRequest;
use App\Http\Requests\Movimientos\UpdateIngresosRequest;

class IngresosController extends Controller
{
    
    public function index()
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


         $ingresos = DB::table('ingresos as a')
        ->select('a.id','a.producto','a.cantidad','a.fechaingreso','b.nombre','c.nombres','a.id_empresa','a.id_sucursal')
        ->join('empresas as b','a.id_empresa','b.id')
        ->join('locales as c','a.id_sucursal','c.id')
        ->where('a.id_empresa','=', $usuarioEmp)
        ->where('a.id_sucursal','=', $usuarioSuc)
        ->orderby('a.created_at','desc')
        ->paginate(1000);

        $productos = Productos::with('name');

        return view('movimientos.ingresos.index', compact('productos','ingresos'));
    }

   
    public function create()
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

       //$producto = Productos::get()->pluck('name','name');
        $producto = DB::table('productos')
        ->select('*')
        ->where('id_empresa','=', $usuarioEmp)
        ->where('id_sucursal','=', $usuarioSuc)
        ->get()->pluck('name','id');

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

        $searchproduct = DB::table('productos')
                    ->select('*')
                   // ->where('estatus','=','1')
                    ->where('id','=', $request->producto)
                    ->get();
       

        foreach ($searchproduct as $prod) {
                    $idproduc = $prod->id;
                    $nombreprod = $prod->name;
                    $cantidadprod = $prod->cantidad;
                }
             
       $ingresos = new Ingresos;
       $ingresos->producto =$nombreprod;
       $ingresos->cantidad     =$request->cantidad;
       $ingresos->fechaingreso     =$request->fechaingreso;
       $ingresos->id_empresa     =$usuarioEmp;
       $ingresos->id_sucursal     =$usuarioSuc;
       $ingresos->save();

       $productos=Productos::where('id', '=' , $idproduc)->get()->first();
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
     

        $ingresos = Ingresos::findOrFail($id);
         $producto = DB::table('productos')
        ->select('*')
        ->where('id_empresa','=', $usuarioEmp)
        ->where('id_sucursal','=', $usuarioSuc)
        ->get()->pluck('name','name');

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
