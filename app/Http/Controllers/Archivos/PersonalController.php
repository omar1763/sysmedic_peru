<?php

namespace App\Http\Controllers\Archivos;

use App\Personal;
use App\Empresas;
use App\Locales;
use App\User;
use DB;
use Silber\Bouncer\Database\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\Archivos\StorePersonalRequest;
use App\Http\Requests\Archivos\UpdatePersonalRequest;

class PersonalController extends Controller
{
    /**
     * Display a listing of User.
     *
     * @return \Illuminate\Http\Response
     */
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


          $personal = DB::table('personals as a')
        ->select('a.id','a.name','a.apellidos','a.dni','a.telefono','a.direccion','a.email','a.estatus','b.nombre','c.nombres','a.id_empresa','a.id_sucursal')
        ->join('empresas as b','a.id_empresa','b.id')
        ->join('locales as c','a.id_sucursal','c.id')
        ->where('a.id_empresa','=', $usuarioEmp)
        ->where('a.id_sucursal','=', $usuarioSuc)
        ->orderby('a.created_at','desc')
        ->paginate(5000);


        return view('archivos.personal.index', compact('personal'));
    }


 


     public static function perbyemp(){


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



             $personal   = Personal::select(
             DB::raw("CONCAT(apellidos,' ',name) AS descripcion"),'id')                  
                             ->where('id_empresa',$usuarioEmp)
                             ->where('id_sucursal',$usuarioSuc)
                             ->orderby('apellidos','ASC')
                             ->get()->pluck('descripcion','id');
            
         if(!is_null($personal)){
           return view("existencias.atencion.perbyemp",['personal'=>$personal]);
         }else{
            return view("existencias.atencion.perbyemp",['personal'=>[]]);
         }

    }

    /**
     * Show the form for creating new User.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        

        return view('archivos.personal.create');
    }

    /**
     * Store a newly created User in storage.
     *
     * @param  \App\Http\Requests\StoreUsersRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePersonalRequest $request)
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

       $personal = new Personal;
       $personal->name =$request->name;
       $personal->apellidos     =$request->apellidos;
       $personal->telefono     =$request->telefono;
       $personal->direccion     =$request->direccion;
       $personal->email     =$request->email;
       $personal->dni     =$request->dni;
       $personal->id_empresa= $usuarioEmp;
       $personal->id_sucursal =$usuarioSuc;
       $personal->save();

        return redirect()->route('admin.personal.index');
    }


    /**
     * Show the form for editing User.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        

        $personal = Personal::findOrFail($id);

        return view('archivos.personal.edit', compact('personal', 'roles'));
    }

    /**
     * Update User in storage.
     *
     * @param  \App\Http\Requests\UpdateUsersRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePersonalRequest $request, $id)
    {
        
        $personal = Personal::findOrFail($id);
        $personal->update($request->all());
       
        return redirect()->route('admin.personal.index');
    }

    /**
     * Remove User from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        $personal = Personal::findOrFail($id);
        $personal->delete();

        return redirect()->route('admin.personal.index');
    }

    /**
     * Delete all selected User at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        
        if ($request->input('ids')) {
            $entries = Personal::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }

}
