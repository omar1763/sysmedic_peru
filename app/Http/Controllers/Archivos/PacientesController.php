<?php

namespace App\Http\Controllers\Archivos;

use App\Pacientes;
use App\Provincia;
use App\Distrito;
use App\EdoCivil;
use App\GradoInstruccion;
use App\HistoriasClinicas;
use App\HistoriaPacientes;
use App\Empresas;
use App\Locales;
use DB;
use Response;
use Validator;
use Silber\Bouncer\Database\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Archivos\StorePacientesRequest;
use App\Http\Requests\Archivos\UpdatePacientesRequest;


class PacientesController extends Controller
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

        $pacientes = DB::table('pacientes as a')
        ->select('a.id','a.nombres','a.apellidos','a.dni','a.provincia','a.distrito','a.direccion','a.gradoinstruccion','a.telefono','a.ocupacion','a.edocivil','a.fechanac','a.created_at','b.historia')
        ->join('historias_clinicas as b','a.id','b.id_paciente')
        ->where('a.id_empresa','=',$usuarioEmp)
        ->where('a.id_sucursal','=',$usuarioSuc)
        ->where('a.estatus','=','1')
        ->orderby('a.created_at','desc')
        ->paginate(5000);

        $provincia= Provincia::with('nombre','id');
        $distrito = Distrito::with('nombre');
        $edocivil = EdoCivil::with('nombre');
        $gradoinstruccion = GradoInstruccion::with('nombre');

        return view('archivos.pacientes.index', compact('pacientes','provincia','distrito','edocivil','gradoinstruccion'));
    }


     public function distbypro($id)
    {
     
      $distritos = Distrito::distbypro($id);
     
      return view('archivos.pacientes.distbypro', compact('distritos'));
    }



    public function create()
    {
        

       $provincia = Provincia::get()->pluck('nombre', 'nombre');
       $edocivil = EdoCivil::get()->pluck('nombre', 'nombre');
       $gradoinstruccion = GradoInstruccion::get()->pluck('nombre', 'nombre');


        return view('archivos.pacientes.create', compact('provincia','edocivil','gradoinstruccion'));
    }


   public function createmodal()
    {

       $provincia = Provincia::get()->pluck('nombre', 'nombre');
       $edocivil = EdoCivil::get()->pluck('nombre', 'nombre');
       $distritos = Distrito::get()->pluck('nombre', 'nombre');
       $gradoinstruccion = GradoInstruccion::get()->pluck('nombre', 'nombre');


        return view('archivos.pacientes.createmodal', compact('provincia','distritos','edocivil','gradoinstruccion'));
    }
    

    public function pacDNI(StorePacientesRequest $request){

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

        $searchpacienteDNI = DB::table('pacientes')
                    ->select('*')
                   // ->where('estatus','=','1')
                    ->where('dni','=', $request->dni)
                    ->where('id_empresa','=',$usuarioEmp)
                    ->where('id_sucursal','=',$usuarioSuc)
                    ->get();

           if (count($searchpacienteDNI) > 0){

              return true;
           } else {

              return false;
           }

    }
    
    


    public function store (StorePacientesRequest $request)
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

              /*  Validator::make($request->all(), [
                  'dni' => 'required|unique:pacientes',
                ])->validate();*/



      If (PacientesController::pacDNI($request)){ 

      return redirect()->back()->with("error", " EL DNI INTRODUCIDO YA ESTA REGISTRADO PARA UN PACIENTE");

      } else {

       $pacientes = new Pacientes;
       $pacientes->dni =$request->dni;
       $pacientes->nombres     =$request->nombres;
       $pacientes->apellidos     =$request->apellidos;
       $pacientes->direccion     =$request->direccion;
       $pacientes->provincia     =$request->provincia;
       $pacientes->distrito     =$request->distritos;
       $pacientes->telefono     =$request->telefono;
       $pacientes->fechanac     =$request->fechanac;
       $pacientes->gradoinstruccion     =$request->gradoinstruccion;
       $pacientes->ocupacion     =$request->ocupacion;
       $pacientes->edocivil     =$request->edocivil;
       $pacientes->id_empresa     =$usuarioEmp;
       $pacientes->id_sucursal     =$usuarioSuc;
       $pacientes->save();


       $historia = new HistoriasClinicas;
       $historia->id_paciente =$pacientes->id;
       $historia->historia    =HistoriaPacientes::generarHistoria($usuarioEmp,$usuarioSuc);
       $historia->save();

      }

    
        return redirect()->route('pacientes.index');
    }


     public function store2 (StorePacientesRequest $request)
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

      If (PacientesController::pacDNI($request)){ 

         return redirect()->back()->with("error", " EL DNI INTRODUCIDO YA ESTA REGISTRADO PARA UN PACIENTE");


      } else {
       $pacientes = new Pacientes;
       $pacientes->dni =$request->dni;
       $pacientes->nombres     =$request->nombres;
       $pacientes->apellidos     =$request->apellidos;
       $pacientes->direccion     =$request->direccion;
       $pacientes->provincia     =$request->provincia;
       $pacientes->distrito     =$request->distritos;
       $pacientes->telefono     =$request->telefono;
       $pacientes->fechanac     =$request->fechanac;
       $pacientes->gradoinstruccion     =$request->gradoinstruccion;
       $pacientes->ocupacion     =$request->ocupacion;
       $pacientes->edocivil     =$request->edocivil;
       $pacientes->id_empresa     =$usuarioEmp;
       $pacientes->id_sucursal     =$usuarioSuc;
       $pacientes->save();

      }

       $historia = new HistoriasClinicas;
       $historia->id_paciente =$pacientes->id;
       $historia->historia    =HistoriaPacientes::generarHistoria($usuarioEmp,$usuarioSuc);
       $historia->save();
      

    
        return redirect()->route('admin.atencion.create');
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
     

       $pacientes = Pacientes::findOrFail($id);
       $provincia = Provincia::get()->pluck('nombre', 'nombre');
       $distrito = Distrito::get()->pluck('nombre', 'nombre');
       $edocivil = EdoCivil::get()->pluck('nombre', 'nombre');
       $gradoinstruccion = GradoInstruccion::get()->pluck('nombre', 'nombre');

        return view('archivos.pacientes.edit', compact('pacientes', 'provincia','distrito','edocivil','gradoinstruccion'));
    }

       public function ver($id)
    {
       

       $pacientes = Pacientes::findOrFail($id);
       $provincia = Provincia::get()->pluck('nombre', 'nombre');
       $distrito = Distrito::get()->pluck('nombre', 'nombre');
       $edocivil = EdoCivil::get()->pluck('nombre', 'nombre');
       $gradoinstruccion = GradoInstruccion::get()->pluck('nombre', 'nombre');

        return view('archivos.pacientes.ver', compact('pacientes', 'provincia','distrito','edocivil','gradoinstruccion'));
    }

    /**
     * Update User in storage.
     *
     * @param  \App\Http\Requests\UpdateUsersRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePacientesRequest $request, $id)
    {
        if (! Gate::allows('users_manage')) {
            return abort(401);
        }
        $pacientes = Pacientes::findOrFail($id);
        $pacientes->update($request->all());
      
        return redirect()->route('pacientes.index');
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
        $pacientes = Pacientes::findOrFail($id);
        $pacientes->delete();

        return redirect()->route('pacientes.index');
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
            $entries = Pacientes::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


     public static function generarHistoria(){
        
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

      
        $searchContador= DB::table('historia_pacientes')
                    ->select('*')
                    ->where('id_empresa','=',$usuarioEmp)
                    ->where('id_sucursal','=', $usuarioSuc)
                    ->get();

        $contador=1;
          if(count($searchContador) ==0){
            $contador=1;
          
            $historia = new HistoriaPacientes;
            $historia->historia=$contador;
            $historia->id_empresa=$usuarioEmp;
            $historia->id_sucursal=$usuarioSuc;
            $historia->save();

          
        } else {
         foreach ($searchContador as $correlativo){
            $contador=$correlativo->historia+1;

         
            $historia=HistoriaPacientes::findOrFail($correlativo->id);
            $historia->historia=$contador;
            $historia->updated_at=date('Y-m-d H:i:s');
            $historia->update();

        } 
    }

    return str_pad($contador, 4, "0", STR_PAD_LEFT);

    }


}
