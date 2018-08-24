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
use App\Analisis;
use App\Paquetes;
use App\PaquetesServ;
use App\Laboratorios;
use App\AtencionLaboratorio;
use App\AtencionServicios;
use App\AtencionPaquetes;
use App\AtencionProfesionalesServicio;
use App\AtencionProfesionalesLaboratorio;
use App\Creditos;
use App\Ingresos;
use Carbon\Carbon;
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
                    ->first();                    
                    //->get();
                    
                    $usuarioEmp = $searchUsuarioID->id_empresa;
                    $usuarioSuc = $searchUsuarioID->id_sucursal;
                    
 /*           foreach ($searchUsuarioID as $usuario) {
                    $usuarioEmp = $usuario->id_empresa;
                    $usuarioSuc = $usuario->id_sucursal;
                }
        */
    $fechaHoy = date('YYYY-m-d');

    if(! is_null($request->fecha)) {
        $f1 = $request->fecha;

        $atencion = DB::table('atencions as a')
        ->select('a.id','a.created_at','a.id_empresa','a.id_sucursal','d.id_atencion','d.id_paciente','d.costo','d.costoa','d.porcentaje','d.acuenta','d.observaciones','d.origen as origen','e.nombres','e.apellidos','f.id','f.detalle')
        ->join('empresas as b','a.id_empresa','b.id')
        ->join('locales as c','a.id_sucursal','c.id')
        ->join('atencion_detalles as d','a.id','d.id_atencion')
        ->join('pacientes as e','d.id_paciente','e.id')
        ->join('servicios as f','d.id_servicio','f.id')
        //->join('atencion_paquetes as g','g.id_atencion','a.id')
        //->join('paquetes as h','h.id','g.id_paquete')
        ->where('a.id_empresa','=', $usuarioEmp)
        ->where('a.id_sucursal','=', $usuarioSuc)
        ->where('a.created_at','=', $f1)
        //->orwhereDate('a.created_at', '=', Carbon::now()->format('Y-m-d'))
        ->orderby('a.created_at','desc')
        ->paginate(1000);
 //      ->toSql();
//dd($atencion);
       // dd(DB::getQueryLog());
    } else {

      $atencion = DB::table('atencions as a')
      ->select('a.id','d.id_atencion','d.id_paciente','d.costo','d.costoa','d.origen as origen','d.porcentaje','d.acuenta','d.observaciones','d.id_paciente')
      
      ->join('atencion_detalles as d','a.id','d.id_atencion')

      ->where('a.id_empresa','=', $usuarioEmp)
      ->where('a.id_sucursal','=', $usuarioSuc)
      ->whereDate('a.created_at', '=', Carbon::now()->format('Y-m-d'))
      ->orderby('a.created_at','desc')
      ->paginate(1000);
//               ->toSql();
//        dd($atencion); 

      //  dd(DB::getQueryLog());
    }


        $servicios = new Servicios();
        $analisis = new Analisis();
        $paquete = new Paquetes();
        $paquetes = new PaquetesServ();
        $atenciondetalle = new AtencionDetalle();
        
        

        return view('existencias.atencion.index', compact('atencion','servicios','analisis','paquete','paquetes','atenciondetalle'));
    }

      public function indexFecha(Request $request)
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
        
        //   $f1 = date('d-m-YYYY');
      $f1 = date('Y-m-d');

    if(! is_null($request->fecha)) {
        $f1 = $request->fecha;
    
    }

        $atencion = DB::table('atencions as a')
        ->select('a.id','a.created_at','a.id_empresa','a.id_sucursal','d.id_atencion','d.id_paciente','d.costo','d.costoa','d.porcentaje','d.acuenta','d.observaciones','e.nombres','e.apellidos','f.id','f.detalle')
        ->join('empresas as b','a.id_empresa','b.id')
        ->join('locales as c','a.id_sucursal','c.id')
        ->join('atencion_detalles as d','a.id','d.id_atencion')
        ->join('pacientes as e','d.id_paciente','e.id')
        ->join('servicios as f','d.id_servicio','f.id')
        ->where('a.id_empresa','=', $usuarioEmp)
        ->where('a.id_sucursal','=', $usuarioSuc)
        ->where('a.created_at','=', $f1)
        //->whereDate('a.created_at', '=', Carbon::now()->format('Y-m-d'))
        ->orderby('a.created_at','desc')
        ->paginate(500);


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
    public function create(Request $request)
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
                             ->get()->pluck('detalle','id');
       $paquetes = Paquetes::where('id_empresa',$usuarioEmp)
                             ->where('id_sucursal',$usuarioSuc)
                             ->get()->pluck('name','id');
       $personal = Personal::where('id_empresa',$usuarioEmp)
                             ->where('id_sucursal',$usuarioSuc)
                             ->get()->pluck('name','id');
       $pacientes = Pacientes::where('id_empresa',$usuarioEmp)
                             ->where('id_sucursal',$usuarioSuc)
                             ->get()->pluck('dni','id');
       $analises = Analisis::where('id_empresa',$usuarioEmp)
                             ->where('id_sucursal',$usuarioSuc)
                             ->get()->pluck('name','id');

       $profesional = Profesionales::select(
            DB::raw("CONCAT(name,' ',apellidos) AS descripcion"),'id')
           
       ->where('id_empresa',$usuarioEmp)
                             ->where('id_sucursal',$usuarioSuc)
                             ->get()->pluck('descripcion','id');

        $request->session()->put('service_price', 0);
        $request->session()->put('analises_price', 0);

        return view('existencias.atencion.create', compact('servicios','personal','pacientes','profesional','analises','paquetes'));
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
        ->select('a.id','a.id_empresa','a.id_sucursal','a.dni','a.nombres','a.apellidos','a.direccion','a.telefono','d.historia')
        ->join('empresas as b','a.id_empresa','b.id')
        ->join('locales as c','a.id_sucursal','c.id')
        ->join('historias_clinicas as d','a.id','d.id_paciente')
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

      public function dataServicios($id){

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
        ->select('a.id','a.detalle','a.precio','a.porcentaje')
        ->join('empresas as b','a.id_empresa','b.id')
        ->join('locales as c','a.id_sucursal','c.id')
        ->where('a.id_empresa','=', $usuarioEmp)
        ->where('a.id_sucursal','=', $usuarioSuc)
        ->where('a.id','=',$id)
       // ->orderby('a.created_at','desc')
        ->get();

         if(!is_null($servicios)){
            return $servicios;
         }else{
            return false;
         }  

     }



     public function verDataPacientes($id){
    
      $pacientes= AtencionController::dataPacientes($id);
      
      return view('existencias.atencion.dataPacientes',['pacientes'=>$pacientes]);

    }



     public function verDataServicios($id){
    
      $servicios= AtencionController::dataServicios($id);
      
      return view('existencias.atencion.dataServicios',['servicios'=>$servicios]);

    }   

    public function cardainput($id, Request $request){
        $filter=explode('*', $id);

        $precio='';
        $porcentaje='';
        if ($filter[1]=='servicios') {          
         $servicios= DB::table('servicios')
         ->select('precio','porcentaje')     
         ->where('id','=',$filter[0])
         ->first();

         $precio=$servicios->precio;
         $porcentaje=$servicios->porcentaje;
     } else {
        $paquetes= DB::table('paquetes')
        ->select('costo')     
        ->where('id','=',$filter[0])
        ->first();
        $precio=$paquetes->costo;
        $porcentaje='';
    } 

        $precio = 0;
        $porcentaje = 0;

        switch ($filter[1]) {
            case 'servicios':
                    $servicios= DB::table('servicios')
                        ->select('precio','porcentaje')     
                        ->whereIn('id',explode(',', $filter[0]))
                        ->get();
                    
                    foreach ($servicios as $servicio) {
                        $precio += (float)$servicio->precio;
                    }

                    $request->session()->put('service_price', $precio);
                    
                    $precio = $precio;
                    
                break;
        }


    return response()->json([
      'precioserv' => $precio
  ]);

}

public function cardainput2($id, Request $request){

        $filter=explode('*', $id);

        $preciopublicoana='';
        if ($filter[1]=='analises') {          
         $analises= DB::table('analises')
         ->select('preciopublico')     
         ->where('id','=',$filter[0])
         ->first();

         $preciopublicoana=$analises->preciopublico;
     } else {
       
    } 

        $preciopublicoana = 0;

        switch ($filter[1]) {
            case 'analises':
                    $analises= DB::table('analises')
                        ->select('preciopublico')     
                        ->whereIn('id',explode(',', $filter[0]))
                        ->get();
                    foreach ($analises as $ana) {
                        $preciopublicoana += (float)$ana->preciopublico;
                    }

                    
                    $preciopublicoana = $preciopublicoana;
                  
                break;

        }


    return response()->json([
      'preciopublico' => $preciopublicoana
  ]);

}

public function cardainput3($id, Request $request){
        $filter=explode('*', $id);

        $precio='';
        if ($filter[1]=='paquetes') {          
         $paquetes= DB::table('paquetes')
         ->select('costo')     
         ->where('id','=',$filter[0])
         ->first();

         $costo=$paquetes->costo;
     } else {
        $paquetes= DB::table('paquetes')
        ->select('costo')     
        ->where('id','=',$filter[0])
        ->first();
        $costo=$paquetes->costo;
    } 

        $precio = 0;

        switch ($filter[1]) {
            case 'paquetes':
                    $paquetes= DB::table('paquetes')
                        ->select('costo')     
                        ->whereIn('id',explode(',', $filter[0]))
                        ->get();
                    
                    foreach ($paquetes as $paq) {
                        $costo += (float)$paq->costo;
                    }

                    $request->session()->put('paquetes_price', $costo);
                    
                    $costo = $costo + $request->session()->get('paquetes_price');

                break;

        }


    return response()->json([
      'costo' => $costo
  ]);

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
    public function store(StoreAtencionRequest $request)
    {
       // dd();

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

    

       $atencion = new Atencion;
       $atencion->id_empresa     =$usuarioEmp;
       $atencion->id_sucursal     =$usuarioSuc;
       $atencion->save();

       $atenciondetalle = new AtencionDetalle;
       $atenciondetalle->id_atencion     =$atencion->id;
       $atenciondetalle->id_paciente     =$request->pacientes;
       $atenciondetalle->costo           =$request->preciototal;
       $atenciondetalle->acuenta         =$request->acuenta;
       $atenciondetalle->costoa          =$request->costoa;
       $atenciondetalle->origen          =$request->origen_paciente;
       $atenciondetalle->pendiente       =($request->preciototal-$request->costoa);
       $atenciondetalle->tarjeta         =$request->tarjeta;
       $atenciondetalle->porcentaje      =($request->porcentaje*$request->preciototal)/100;
       $atenciondetalle->observaciones   =$request->observaciones;
       $atenciondetalle->save();

       $creditos = new Creditos;
       $creditos->id_atencion    =$atencion->id;
       $creditos->monto          =$request->costoa;
       $creditos->tipo_ingreso   =$request->acuenta;
       $creditos->origen          ='INGRESO DE ATENCIONES';
       $creditos->id_empresa     =$usuarioEmp;
       $creditos->id_sucursal    =$usuarioSuc;
       $creditos->save();

      
       if(! is_null($request->analises)){
           $analisisatencion = new AtencionLaboratorio;
           $analisisatencion->id_atencion =$atencion->id;
           $analisisatencion->id_analisis    =0;
           $analisisatencion->origen    ='Laboratorios';
           $analisisatencion->id_profesional =$request->profesional;
           $analisisatencion->porcentaje =($request->porcentajelab*$request->preciopublico)/100;
           $analisisatencion->montolab = $request->preciopublico;
           $analisisatencion->id_sucursal =$usuarioSuc;
           $analisisatencion->id_empresa =$usuarioEmp;
           $analisisatencion->save();

           foreach ($request->analises as $key => $value) {
                $serviciosproflab = new AtencionProfesionalesLaboratorio;
                $serviciosproflab->id_atencion =$atencion->id;
                $serviciosproflab->id_laboratorio    =$value;
                $serviciosproflab->id_profesional =$request->profesional;
                $serviciosproflab->porcentaje =($request->porcentajelab*$request->preciopublico)/100;
                $serviciosproflab->montolab = $request->preciopublico;
                $serviciosproflab->id_sucursal =$usuarioSuc;
                $serviciosproflab->id_empresa =$usuarioEmp;
                $serviciosproflab->save();
           }
   }


         if(! is_null($request->servicios)){

                $serviciosatencion = new AtencionServicios;
                $serviciosatencion->id_atencion =$atencion->id;
                $serviciosatencion->id_servicio    =0;
                $serviciosatencion->origen    ='Servicios';
                $serviciosatencion->id_profesional =$request->profesional;
                $serviciosatencion->porcentaje =($request->porcentajeserv*$request->precioserv)/100;
                $serviciosatencion->montoser = $request->precioserv;
                $serviciosatencion->id_sucursal =$usuarioSuc;
                $serviciosatencion->id_empresa =$usuarioEmp;
                $serviciosatencion->save();
            foreach ($request->servicios as $key => $value) {
                $serviciosprofatencion = new AtencionProfesionalesServicio;
                $serviciosprofatencion->id_atencion =$atencion->id;
                $serviciosprofatencion->id_servicio    =$value;
                $serviciosprofatencion->id_profesional =$request->profesional;
                $serviciosprofatencion->porcentaje =($request->porcentajeserv*$request->precioserv)/100;
                $serviciosprofatencion->montoser = $request->precioserv;
                $serviciosprofatencion->id_sucursal =$usuarioSuc;
                $serviciosprofatencion->id_empresa =$usuarioEmp;
                $serviciosprofatencion->save();

            }

        }
       
       if(isset($request->paquetes)){
           foreach ($request->paquetes as $key => $value) {
             $paquetesatencion = new AtencionPaquetes;
             $paquetesatencion->id_atencion =$atencion->id;
             $paquetesatencion->id_paquete    =$value;
             $paquetesatencion->id_sucursal =$usuarioSuc;
             $paquetesatencion->id_empresa =$usuarioEmp;
             $paquetesatencion->save();
         } 
     }
      
      

        return redirect()->route('admin.atencion.index');
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

            dd($id);
            die();
           
            $paquetes = Paquetes::where('id_empresa',$usuarioEmp)
            ->where('id_sucursal',$usuarioSuc)
            ->get()->pluck('name','id');
            $personal = Personal::where('id_empresa',$usuarioEmp)
            ->where('id_sucursal',$usuarioSuc)
            ->get()->pluck('name','id');
            $pacientes = Pacientes::where('id_empresa',$usuarioEmp)
            ->where('id_sucursal',$usuarioSuc)
            ->get()->pluck('dni','id');
            $profesional = Profesionales::where('id_empresa',$usuarioEmp)
            ->where('id_sucursal',$usuarioSuc)
            ->get()->pluck('name','id');




       $servicioIds = [];
       $analisisIds = [];
       $servicio = Servicios::all();
       $analises = Analisis::all();
       $atenserv = AtencionServicios::all()->where('id',$id );
       $atenlab = AtencionLaboratorio::all()->where('id',$id );

       foreach($atenserv as $value)
       {
        $servicioIds[] = $value->id_servicio;
      } 
      foreach($atenlab as $value_ana)
      {
        $analisisIds[] = $value_ana->id_analisis;
      } 

            return view('existencias.atencion.editar', compact('atencion','servicio','pacientes','paquetes','personal','analises','profesional','servicioIds','analisisIds'));
        }

    /**
     * Update User in storage.
     *
     * @param  \App\Http\Requests\UpdateUsersRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAtencionRequest $request, $id)
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

        $atencion=Atencion::find($id)->delete();
        $atenciondetalle = AtencionDetalle::where('id_atencion',$id )->delete();
        $atencionlab = AtencionLaboratorio::where('id_atencion',$id )->delete();
        $atencionser = AtencionServicios::where('id_atencion',$id )->delete();
        $atencionlab = AtencionLaboratorio::where('id_atencion',$id )->delete();
        $atencionprofser = AtencionProfesionalesServicio::where('id_atencion',$id )->delete();
        $atencionproflab = AtencionProfesionalesLaboratorio::where('id_atencion',$id )->delete();
        $creditos = Creditos::where('id_atencion',$id )->delete();

        return redirect()->route('admin.atencion.index');
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
            $atencion = Atencion::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }

}
