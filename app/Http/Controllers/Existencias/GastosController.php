<?php

namespace App\Http\Controllers\Existencias;

use App\Gastos;
use App\Debitos;
use App\Empresas;
use App\Locales;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\Existencias\StoreGastosRequest;
use App\Http\Requests\Existencias\UpdateGastosRequest;

class GastosController extends Controller
{
    /**
     * Display a listing of User.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
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
         
         
                      
        
            $f1 = date('YYYY-m-d');

            if(! is_null($request->fecha)) {
                $f1 = $request->fecha;
                  $gastos = DB::table('gastos as a')
                    ->select('a.id','a.name','a.concepto','a.monto','a.id_empresa','a.id_sucursal','a.created_at')
                    ->join('empresas as b','a.id_empresa','b.id')
                    ->join('locales as c','a.id_sucursal','c.id')
                    ->where('a.id_empresa','=', $usuarioEmp)
                    ->where('a.id_sucursal','=', $usuarioSuc)
                    ->where('a.created_at','=', $f1)
                    //->whereDate('a.created_at', '=', Carbon::now()->format('Y-m-d'))
                    ->orderby('a.created_at','desc')
                    ->paginate(500);
            } else {
 
                     $gastos = DB::table('gastos as a')
                    ->select('a.id','a.name','a.concepto','a.monto','a.id_empresa','a.id_sucursal','a.created_at')
                    ->join('empresas as b','a.id_empresa','b.id')
                    ->join('locales as c','a.id_sucursal','c.id')
                    ->where('a.id_empresa','=', $usuarioEmp)
                    ->where('a.id_sucursal','=', $usuarioSuc)
                    ->whereDate('a.created_at', '=', Carbon::now()->format('Y-m-d'))
                    ->orderby('a.created_at','desc')
                    ->paginate(500);

            }


        return view('existencias.gastos.index', compact('gastos'));
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

        return view('existencias.gastos.create');
    }

    /**Ll
     * Store a newly created User in storage.
     *
     * @param  \App\Http\Requests\StoreUsersRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreGastosRequest $request)
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

       $gastos = new Gastos;
       $gastos->name =$request->name;
       $gastos->concepto     =$request->concepto;
       $gastos->monto     =$request->monto;
       $gastos->id_empresa= $usuarioEmp;
       $gastos->id_sucursal =$usuarioSuc;
       $gastos->save();

       $debitos = new Debitos;
       $debitos->id_gasto= $gastos->id;
       $debitos->descripcion =$gastos->concepto;
       $debitos->origen ='RELACION DE GASTOS';
       $debitos->monto     =$gastos->monto;
       $debitos->id_empresa= $usuarioEmp;
       $debitos->id_sucursal =$usuarioSuc;
       $debitos->save();


        return redirect()->route('admin.gastos.index');
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

        $gastos = Gastos::findOrFail($id);

        return view('existencias.gastos.edit', compact('gastos'));
    }

    /**
     * Update User in storage.
     *
     * @param  \App\Http\Requests\UpdateUsersRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateGastosRequest $request, $id)
    {
        if (! Gate::allows('users_manage')) {
            return abort(401);
        }
        $gastos = Gastos::findOrFail($id);
        $gastos->update($request->all());

        $debitos=Debitos::where("id_gasto","=",$id)
                          ->update(['monto' => $request->monto,'descripcion' => $gastos->concepto]);

       
        return redirect()->route('admin.gastos.index');
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
        $gastos = Gastos::findOrFail($id);
        $gastos->delete();

        $debitos = Debitos::where('id_gasto',$id )->delete();


        return redirect()->route('admin.gastos.index');
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
            $entries = Gastos::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }

}
