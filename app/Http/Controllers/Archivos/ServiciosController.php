<?php

namespace App\Http\Controllers\Archivos;

use App\Servicios;
use App\Empresas;
use App\Locales;
use DB;
use Illuminate\Support\Facades\Auth;
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


         $servicios = DB::table('servicios as a')
        ->select('a.id','a.detalle','a.precio','a.porcentaje','b.nombre','c.nombres','a.id_empresa','a.id_sucursal')
        ->join('empresas as b','a.id_empresa','b.id')
        ->join('locales as c','a.id_sucursal','c.id')
        ->where('a.id_empresa','=', $usuarioEmp)
        ->where('a.id_sucursal','=', $usuarioSuc)
        ->orderby('a.created_at','desc')
        ->paginate(5000);

        return view('archivos.servicios.index', compact('servicios'));
    }

  public function prueba(){
    echo  "hola";
    }


   public static function servbyemp(){


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


             $servicio = DB::table('servicios as a')
                     ->select('a.id','a.detalle','a.precio','a.porcentaje','b.nombre','c.nombres','a.id_empresa','a.id_sucursal')
                     ->join('empresas as b','a.id_empresa','b.id')
                     ->join('locales as c','a.id_sucursal','c.id')
                     ->where('a.id_empresa','=', $usuarioEmp)
                     ->where('a.id_sucursal','=', $usuarioSuc)
                     ->get()->pluck('detalle','id');

                //    $newData = json_decode($servicio,TRUE);
            
         if(!is_null($servicio)){
           return view("existencias.atencion.servbyemp",['servicio'=>$servicio]);
         }else{
            return view("existencias.atencion.servbyemp",['servicio'=>[]]);
         }

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

       $servicios = new Servicios;
       $servicios->detalle =$request->detalle;
       $servicios->precio     =$request->precio;
       $servicios->id_empresa= $usuarioEmp;
       $servicios->id_sucursal =$usuarioSuc;
       $servicios->save();


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
