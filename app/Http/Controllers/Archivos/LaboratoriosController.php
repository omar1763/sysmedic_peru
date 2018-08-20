<?php

namespace App\Http\Controllers\Archivos;

use App\Laboratorios;
use App\Empresas;
use App\Locales;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\Archivos\StoreLaboratoriosRequest;
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


         $laboratorio = DB::table('laboratorios as a')
        ->select('a.id','a.name','a.direccion','a.referencia','b.nombre','c.nombres','a.id_empresa','a.id_sucursal')
        ->join('empresas as b','a.id_empresa','b.id')
        ->join('locales as c','a.id_sucursal','c.id')
        ->where('a.id_empresa','=', $usuarioEmp)
        ->where('a.id_sucursal','=', $usuarioSuc)
        ->orderby('a.created_at','desc')
        ->paginate(5000);


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

    /**Ll
     * Store a newly created User in storage.
     *
     * @param  \App\Http\Requests\StoreUsersRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreLaboratoriosRequest $request)
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

       $laboratorio = new Laboratorios;
       $laboratorio->name =$request->name;
       $laboratorio->direccion     =$request->direccion;
       $laboratorio->referencia     =$request->referencia;
       $laboratorio->id_empresa= $usuarioEmp;
       $laboratorio->id_sucursal =$usuarioSuc;
       $laboratorio->save();

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
            $entries = Laboratorios::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }

}
