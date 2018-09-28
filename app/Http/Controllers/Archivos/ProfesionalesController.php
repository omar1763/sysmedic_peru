<?php

namespace App\Http\Controllers\Archivos;

use App\Profesionales;
use App\Centros;
use App\Especialidad;
use App\Empresas;
use App\Locales;
use DB;
use Silber\Bouncer\Database\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\Archivos\StoreProfesionalesRequest;
use App\Http\Requests\Archivos\UpdateProfesionalesRequest;

class ProfesionalesController extends Controller
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


         $profesionales = DB::table('profesionales as a')
        ->select('a.id','a.name','a.apellidos','a.especialidad','a.cmp','a.centro','a.codigo','a.nacimiento','b.nombre','c.nombres','a.id_empresa','a.id_sucursal')
        ->join('empresas as b','a.id_empresa','b.id')
        ->join('locales as c','a.id_sucursal','c.id')
        ->where('a.id_empresa','=', $usuarioEmp)
        ->where('a.id_sucursal','=', $usuarioSuc)
        ->orderby('a.created_at','desc')
        ->paginate(5000);


        $centro = Centros::with('centro');

        return view('archivos.profesionales.index', compact('profesionales','centro'));
    }

     public static function probyemp(){


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


             $profesional   = Profesionales::select(
             DB::raw("CONCAT(apellidos,' ',name) AS descripcion"),'id')                  
                             ->where('id_empresa',$usuarioEmp)
                             ->where('id_sucursal',$usuarioSuc)
                             ->orderby('apellidos','ASC')
                             ->get()->pluck('descripcion','id');

            
         if(!is_null($profesional)){
           return view("existencias.atencion.probyemp",['profesional'=>$profesional]);
         }else{
            return view("existencias.atencion.probyemp",['profesional'=>[]]);
         }

    }

    /**
     * Show the form for creating new User.
     *
     * @return \Illuminate\Http\Response
     */
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
        $centro = DB::table('centros')
        ->select('*')
        ->where('id_empresa','=', $usuarioEmp)
        ->where('id_sucursal','=', $usuarioSuc)
        ->get()->pluck('name','name');



       $especialidad = Especialidad::get()->pluck('nombre', 'nombre');


        return view('archivos.profesionales.create', compact('centro','especialidad'));
    }

    /**
     * Store a newly created User in storage.
     *
     * @param  \App\Http\Requests\StoreUsersRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProfesionalesRequest $request)
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

       $profesionales = new Profesionales;
       $profesionales->name =$request->name;
       $profesionales->apellidos     =$request->apellidos;
       $profesionales->especialidad     =$request->especialidad;
       $profesionales->cmp     =$request->cmp;
       $profesionales->centro     =$request->centro;
       $profesionales->nacimiento     =$request->nacimiento;
       $profesionales->id_empresa= $usuarioEmp;
       $profesionales->id_sucursal =$usuarioSuc;
       $profesionales->save();

       DB::table('profesionales')
            ->where('id', $profesionales->id)
            ->update(['codigo' => str_pad(($profesionales->id),4, "0", STR_PAD_LEFT)]);
    
       

        return redirect()->route('admin.profesionales.index');
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

       //$producto = Productos::get()->pluck('name','name');
        $centro = DB::table('centros')
        ->select('*')
        ->where('id_empresa','=', $usuarioEmp)
        ->where('id_sucursal','=', $usuarioSuc)
        ->get()->pluck('name','name');
     

        $profesionales = Profesionales::findOrFail($id);
      
        $especialidad = Especialidad::get()->pluck('nombre', 'nombre');

        return view('archivos.profesionales.edit', compact('profesionales', 'roles','centro','especialidad'));
    }

    /**
     * Update User in storage.
     *
     * @param  \App\Http\Requests\UpdateUsersRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProfesionalesRequest $request, $id)
    {
        if (! Gate::allows('users_manage')) {
            return abort(401);
        }
        $profesionales = Profesionales::findOrFail($id);
        $profesionales->update($request->all());
      
        return redirect()->route('admin.profesionales.index');
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
        $profesionales = Profesionales::findOrFail($id);
        $profesionales->delete();

        return redirect()->route('admin.profesionales.index');
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
            $entries = Profesionales::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }

}
