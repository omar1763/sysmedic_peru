<?php

namespace App\Http\Controllers\Existencias;

use App\Atencion;
use App\AtencionDetalle;
use App\Empresas;
use App\Locales;
use App\Servicios;
use App\Personal;
use App\Pacientes;
use App\Profesionales;
use DB;
use Illuminate\Support\Facades\Auth;
use Silber\Bouncer\Database\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Movimientos\StoreAtencionRequest;
use App\Http\Requests\Movimientos\UpdateAtencionRequest;

class AtencionController extends Controller
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


        $atencion = DB::table('atencion as a')
        ->select('a.id','a.id_empresa','a.id_sucursal')
        ->join('empresas as b','a.id_empresa','b.id')
        ->join('locales as c','a.id_sucursal','c.id')
        ->where('a.id_empresa','=', $usuarioEmp)
        ->where('a.id_sucursal','=', $usuarioSuc)
        ->orderby('a.created_at','desc')
        ->paginate(10);


        $servicios = Servicios::with('nombre');
        $personal = Personal::with('dni');
        $pacientes = Pacientes::with('dni');
        $profesionales = Profesionales::with('nombre');

        return view('existencias.atencion.index', compact('atencion','servicios','personal','pacientes','profesionales'));
    }

    public function pagoadelantado(){

        return view('existencias.atencion.pagoadelantado');
    }

    public function pagotarjeta(){

        return view('existencias.atencion.pagotarjeta');
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

       //$producto = Productos::get()->pluck('name', 'name');
       $servicios = Servicios::where('id_empresa',$usuarioEmp)
                             ->where('id_sucursal',$usuarioSuc)
                             ->get()->pluck('name','name');
       $personal = Personal::where('id_empresa',$usuarioEmp)
                             ->where('id_sucursal',$usuarioSuc)
                             ->get()->pluck('name','name');
       $pacientes = Pacientes::where('id_empresa',$usuarioEmp)
                             ->where('id_sucursal',$usuarioSuc)
                             ->get()->pluck('nombres','nombres');
       $profesionales = Profesionales::where('id_empresa',$usuarioEmp)
                             ->where('id_sucursal',$usuarioSuc)
                             ->get()->pluck('name','name');


        return view('existencias.atencion.create', compact('servicios','personal','pacientes','profesionales'));
    }

     public function dataPacientes($id){

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

         $pacientes = DB::table('pacientes as a')
        ->select('a.id','a.id_empresa','a.id_sucursal','a.nombres','a.apellidos','a.direccion','a.telefono')
        ->join('empresas as b','a.id_empresa','b.id')
        ->join('locales as c','a.id_sucursal','c.id')
        ->where('a.id_empresa','=', $usuarioEmp)
        ->where('a.id_sucursal','=', $usuarioSuc)
        ->where('a.id','=',$id)
       // ->orderby('a.created_at','desc')
        ->get();

         if(!is_null($pacientes)){
            return $pacientes;
         }else{
            return false;
         }  

     }



     public function prueba(){
    echo  AtencionController::dataPacientes(8);
    }


     public function verDataPacientes($id){
    
      $pacientes= AtencionController::dataPacientes($id);
      //var_dump($pacientes);
      return view('existencias.atencion.dataPacientes',['pacientes'=>$pacientes]);

    }



     public function servbyemp($id)
    {
      $servicio = Servicios::servbyemp($id);
      return view("existencias.atencion.servbyemp",['servicio'=>$servicio]);
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

       

       $ingresos = new Ingresos;
       $ingresos->producto =$request->producto;
       $ingresos->cantidad     =$request->cantidad;
       $ingresos->fechaingreso     =$request->fechaingreso;
       $ingresos->id_empresa     =$usuarioEmp;
       $ingresos->id_sucursal     =$usuarioSuc;
       $ingresos->save();
        
        $product =Productos::all();
        foreach ($product as $prod) {
                    $nombreprod = $prod->name;
                    $cantidadprod = $prod->cantidad;
                }
      
       $productos=Productos::where('name', '=' , $nombreprod)->get()->first();
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
