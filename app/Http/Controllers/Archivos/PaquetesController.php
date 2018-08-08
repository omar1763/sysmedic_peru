<?php

namespace App\Http\Controllers\Archivos;

use App\Paquetes;
use App\PaquetesServ;
use App\Servicios;
use App\Empresas;
use App\Locales;
use DB;
use Silber\Bouncer\Database\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Archivos\StorePaquetesRequest;
use App\Http\Requests\Archivos\UpdatePaquetesRequest;

class PaquetesController extends Controller
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

        $paquetes = DB::table('paquetes as a')
        ->select('a.id','a.name','a.costo','a.id_empresa','a.id_sucursal','b.id','b.id_paquete','b.id_servicio','c.detalle')
        ->join('paquetes_servs as b','a.id','b.id_paquete')
        ->join('servicios as c','b.id_servicio','c.id')
        ->where('a.id_empresa','=',$usuarioEmp)
        ->where('a.id_sucursal','=',$usuarioSuc)
       // ->where('a.estatus','=','1')
        ->orderby('a.created_at','desc')
        ->paginate(10);

        return view('archivos.paquetes.index', compact('paquetes'));
    }



     public static function paqbyemp(){


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


             $paquetes = DB::table('paquetes as a')
                     ->where('a.id_empresa','=', $usuarioEmp)
                     ->where('a.id_sucursal','=', $usuarioSuc)
                     ->get()->pluck('name','id');
            
         if(!is_null($paquetes)){
           return view("existencias.atencion.paqbyemp",['paquetes'=>$paquetes]);
         }else{
            return view("existencias.atencion.paqbyemp",['paquetes'=>[]]);
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
       $servicio = Servicios::get()->pluck('detalle');
    
        return view('archivos.paquetes.create', compact('servicio'));
    }



    public function store (StorePaquetesRequest $request)
    {
        if (! Gate::allows('users_manage')) {
            return abort(401);
        }
          //  print_r($request->all());
          //  die();
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
       
      
       $paquetes = new Paquetes;
       $paquetes->name =$request->name;
       $paquetes->costo     =$request->costo;
       $paquetes->id_empresa     =$usuarioEmp;
       $paquetes->id_sucursal     =$usuarioSuc;
       $paquetes->save();


       foreach ($request->servicio as $key => $value) {
       $paquetesserv = new PaquetesServ;
       $paquetesserv->id_paquete =$paquetes->id;
       $paquetesserv->id_servicio    =$value;
       $paquetesserv->save();
       }
      

        return redirect()->route('admin.paquetes.index');
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
     

      //$paquetess = Paquetes::findOrFail($id);

       $paquetes = PaquetesServ::findOrFail($id);

       $servicio = Servicios::get()->pluck('detalle');
    

        return view('archivos.paquetes.edit', compact('servicio','paquetes'));
    }

    /**
     * Update User in storage.
     *
     * @param  \App\Http\Requests\UpdateUsersRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePaquetesRequest $request, $id)
    {
        if (! Gate::allows('users_manage')) {
            return abort(401);
        }

     
       $paquetes=Paquetes::findOrFail($id);
       $paquetes->name =$request->name;
       $paquetes->costo     =$request->costo;
       $paquetes->update();


     /*  foreach ($request->servicio as $key => $value) {
       $paquetesserv=PaquetesServ::findOrFail($id);
       $paquetesserv->id_servicio    =$value;
       $paquetesserv->update();
       }*/
      
        return redirect()->route('admin.paquetes.index');
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
        $paquetes = PaquetesServ::findOrFail($id);
        $paquetes->delete();

        return redirect()->route('admin.paquetes.index');
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
            $entries = Paquetes::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }

}
