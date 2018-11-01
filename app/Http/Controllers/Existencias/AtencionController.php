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
use App\PaquetesAnalisis;
use App\Laboratorios;
use App\AtencionLaboratorio;
use App\AtencionServicios;
use App\AtencionPaquetes;
use App\AtencionProfesionalesServicio;
use App\AtencionProfesionalesLaboratorio;
use App\AtencionProfesionalesPaquete;
use App\AtencionProfesionalesPaqueteLab;
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
       

         $id_usuario = Auth::id();

         $searchUsuarioID = DB::table('users')
                    ->select('*')
                   // ->where('estatus','=','1')
                    ->where('id','=', $id_usuario)
                    ->first();                    
                    //->get();
                    
                    $usuarioEmp = $searchUsuarioID->id_empresa;
                    $usuarioSuc = $searchUsuarioID->id_sucursal;
                    

 
    $fechaHoy = date('YYYY-m-d');

    if(! is_null($request->fecha)) {
        $f1 = $request->fecha;

          $atec_lab = DB::table('atencion_profesionales_laboratorios as a')
        ->select('a.id', 'a.id_atencion', 'a.id_laboratorio as id_servicio', 'a.pagado', 'a.porcentaje',
        'a.recibo', 'a.created_at as fecha','a.id_profesional', 'b.costo','b.id_paciente','b.costoa', 'f.name as nombres',
        'f.apellidos', 'b.origen', 'p.nombres as pnombres', 'p.apellidos as papellidos','c.name as detalle','c.preciopublico as precio')
        ->join('profesionales as f','f.id','a.id_profesional')
        ->join('atencion_detalles as b','a.id_atencion','b.id_atencion')
        ->join('pacientes as p','p.id','b.id_paciente')
        ->join('atencion_laboratorios as s', 'a.id_atencion', 's.id_atencion')
        ->join('analises as c','c.id','a.id_laboratorio')
        ->where('a.id_empresa','=', $usuarioEmp)
        ->where('a.id_sucursal','=', $usuarioSuc)
        ->orderby('a.id_atencion','DESC')
        ->where('a.created_at','=', $f1);

         $atec_paq = DB::table('atencion_profesionales_paquetes as a')
        ->select('a.id', 'a.id_atencion', 'a.id_paquete as id_servicio', 'a.pagado', 'a.porcentajepaq as porcentaje',
        'a.recibo', 'a.created_at as fecha','a.id_profesional', 'b.costo','b.id_paciente','b.costoa', 'f.name as nombres',
        'f.apellidos', 'b.origen', 'p.nombres as pnombres', 'p.apellidos as papellidos','c.name as detalle','c.costo as precio')
        ->join('profesionales as f','f.id','a.id_profesional')
        ->join('atencion_detalles as b','a.id_atencion','b.id_atencion')
        ->join('pacientes as p','p.id','b.id_paciente')
        ->join('paquetes as c','c.id','a.id_paquete')
        ->where('a.id_empresa','=', $usuarioEmp)
        ->where('a.id_sucursal','=', $usuarioSuc)
        ->orderby('a.id_atencion','DESC')
        ->groupBy('a.id_atencion')
        ->where('a.created_at','=', $f1);

        $atencion = DB::table('atencion_profesionales_servicios as a')
        ->select('a.id', 'a.id_atencion', 'a.id_servicio', 'a.pagado', 'a.porcentaje', 'a.recibo', 'a.created_at as fecha','a.id_profesional', 'b.costo','b.id_paciente','b.costoa', 'f.name as nombres', 'f.apellidos', 'b.origen', 'p.nombres as pnombres', 'p.apellidos as papellidos','c.detalle as detalle','c.precio')
        ->join('profesionales as f','f.id','a.id_profesional')
        ->join('atencion_detalles as b','a.id_atencion','b.id_atencion')
        ->join('pacientes as p','p.id','b.id_paciente')
        ->join('atencion_servicios as s', 'a.id_atencion', 's.id_atencion')
        ->join('servicios as c','c.id','a.id_servicio')
        ->where('a.id_empresa','=', $usuarioEmp)
        ->where('a.id_sucursal','=', $usuarioSuc)
        ->where('a.created_at','=', $f1)
        ->union($atec_lab)
        ->union($atec_paq)
        ->orderby('id_atencion','DESC')
        ->groupBy('a.id_atencion')
        ->get();


    } else {

          $atec_lab = DB::table('atencion_profesionales_laboratorios as a')
        ->select('a.id', 'a.id_atencion', 'a.id_laboratorio as id_servicio', 'a.pagado', 'a.porcentaje',
        'a.recibo', 'a.created_at as fecha','a.id_profesional', 'b.costo','b.id_paciente','b.costoa', 'f.name as nombres',
        'f.apellidos', 'b.origen', 'p.nombres as pnombres', 'p.apellidos as papellidos','c.name as detalle','c.preciopublico as precio')
        ->join('profesionales as f','f.id','a.id_profesional')
        ->join('atencion_detalles as b','a.id_atencion','b.id_atencion')
        ->join('pacientes as p','p.id','b.id_paciente')
        ->join('atencion_laboratorios as s', 'a.id_atencion', 's.id_atencion')
        ->join('analises as c','c.id','a.id_laboratorio')
        ->where('a.id_empresa','=', $usuarioEmp)
        ->where('a.id_sucursal','=', $usuarioSuc)
        ->orderby('a.id_atencion','DESC')
        ->whereDate('a.created_at', '=', Carbon::now()->format('Y-m-d'));

       /*  $atec_paq = DB::table('atencion_profesionales_paquetes as a')
        ->select('a.id', 'a.id_atencion', 'a.id_paquete as id_servicio', 'a.pagado', 'a.porcentajepaq as porcentaje',
        'a.recibo', 'a.created_at as fecha','a.id_profesional', 'b.costo','b.id_paciente','b.costoa', 'f.name as nombres',
        'f.apellidos', 'b.origen', 'p.nombres as pnombres', 'p.apellidos as papellidos','c.name as detalle','c.costo as precio')
        ->join('profesionales as f','f.id','a.id_profesional')
        ->join('atencion_detalles as b','a.id_atencion','b.id_atencion')
        ->join('pacientes as p','p.id','b.id_paciente')
        ->join('paquetes as c','c.id','a.id_paquete')
        ->where('a.id_empresa','=', $usuarioEmp)
        ->where('a.id_sucursal','=', $usuarioSuc)
        ->orderby('a.id_atencion','DESC')
        ->whereDate('a.created_at', '=', Carbon::now()->format('Y-m-d'));*/

         $atec_lab_paq = DB::table('atencion_profesionales_paquete_labs as a')
        ->select('a.id', 'a.id_atencion', 'a.id_paquete as id_servicio', 'a.pagado', 'a.porcentajepaq as porcentaje',
        'a.recibo', 'a.created_at as fecha','a.id_profesional', 'b.costo','b.id_paciente','b.costoa', 'f.name as nombres',
        'f.apellidos', 'b.origen', 'p.nombres as pnombres', 'p.apellidos as papellidos','c.name as detalle','c.costo as precio')
        ->join('profesionales as f','f.id','a.id_profesional')
        ->join('atencion_detalles as b','a.id_atencion','b.id_atencion')
        ->join('pacientes as p','p.id','b.id_paciente')
        ->join('paquetes as c','c.id','a.id_paquete')
        ->where('a.id_empresa','=', $usuarioEmp)
        ->where('a.id_sucursal','=', $usuarioSuc)
        ->orderby('a.id_atencion','DESC')
        ->groupBy('a.id_atencion')
        ->whereDate('a.created_at', '=', Carbon::now()->format('Y-m-d'));


        $atencion = DB::table('atencion_profesionales_servicios as a')
        ->select('a.id', 'a.id_atencion', 'a.id_servicio', 'a.pagado', 'a.porcentaje', 'a.recibo', 'a.created_at as fecha','a.id_profesional', 'b.costo','b.id_paciente','b.costoa', 'f.name as nombres', 'f.apellidos', 'b.origen', 'p.nombres as pnombres', 'p.apellidos as papellidos','c.detalle as detalle','c.precio')
        ->join('profesionales as f','f.id','a.id_profesional')
        ->join('atencion_detalles as b','a.id_atencion','b.id_atencion')
        ->join('pacientes as p','p.id','b.id_paciente')
        ->join('atencion_servicios as s', 'a.id_atencion', 's.id_atencion')
        ->join('servicios as c','c.id','a.id_servicio')
        ->where('a.id_empresa','=', $usuarioEmp)
        ->where('a.id_sucursal','=', $usuarioSuc)
        ->whereDate('a.created_at', '=', Carbon::now()->format('Y-m-d'))
        ->union($atec_lab)
       // ->union($atec_paq)
        ->union($atec_lab_paq)
        ->orderby('id_atencion','DESC')
        ->get();

    }


        $servicios = new Servicios();
        $analisis = new Analisis();
        $paquete = new Paquetes();
        $paquetes = new PaquetesServ();
        $atenciondetalle = new AtencionDetalle();



       return view('existencias.atencion.index', compact('atencion','servicios','analisis','paquete','paquetes','atenciondetalle'));
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
                             ->orderby('name','ASC')
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

     if ($request->origen_paciente=='Profesional'){
  
       if(! is_null($request->servicios)){

           $serviciosatencion = new AtencionServicios;
           $serviciosatencion->id_atencion =$atencion->id;
           $serviciosatencion->id_servicio    =0;
           $serviciosatencion->origen    ='Servicios';
           $serviciosatencion->id_profesional =$request->profesional;
           $serviciosatencion->porcentaje =$request->porcentajeserv;
           $serviciosatencion->montoser = $request->precioserv;
           $serviciosatencion->id_sucursal =$usuarioSuc;
           $serviciosatencion->id_empresa =$usuarioEmp;
           $serviciosatencion->save();
           foreach ($request->servicios as $key => $value) {

            $searchServ = DB::table('servicios')
            ->select('*')
                   // ->where('estatus','=','1')
            ->where('id','=', $value)
            ->get();

            foreach ($searchServ as $servicios) {
                $precio = $servicios->precio;

            }

               $atenciondetalle = new AtencionDetalle;
       $atenciondetalle->id_atencion     =$atencion->id;
       $atenciondetalle->id_paciente     =$request->pacientes;
       $atenciondetalle->costo           =$request->preciototal;
       $atenciondetalle->origen           =$request->origen_paciente;
       $atenciondetalle->id_profesional =$request->profesional;
       $atenciondetalle->acuenta         =$request->acuenta;
       $atenciondetalle->costoa          =$request->costoa;
       $atenciondetalle->pendiente       =($request->preciototal-$request->costoa);
       $atenciondetalle->tarjeta         =$request->tarjeta;
       $atenciondetalle->porcentaje      =$request->porcentaje;
       $atenciondetalle->observaciones   =$request->observaciones;
       $atenciondetalle->save();


            $serviciosprofatencion = new AtencionProfesionalesServicio;
            $serviciosprofatencion->id_atencion =$atencion->id;
            $serviciosprofatencion->id_servicio    =$value;
            $serviciosprofatencion->id_profesional =$request->profesional;
            $serviciosprofatencion->porcentaje =$request->porcentajeserv;
            $serviciosprofatencion->montoser = $request->precioserv;
            $serviciosprofatencion->pagar = ($precio*$request->porcentajeserv)/100;
            $serviciosprofatencion->id_sucursal =$usuarioSuc;
            $serviciosprofatencion->id_empresa =$usuarioEmp;
                //$serviciosprofatencion->id_atec_servicio =$serviciosatencion->id;
            $serviciosprofatencion->save();
        }
    }

    if(! is_null($request->paquetes)){
     foreach ($request->paquetes as $key => $value) {

        $searchServPaq = DB::table('paquetes_servs')
        ->select('*')
                   // ->where('estatus','=','1')
        ->where('id_paquete','=', $value)
        ->get();

        foreach ($searchServPaq as $serv) {
            $id_servicio = $serv->id_servicio;


            if(! is_null($id_servicio)){

             $paquetesatencion = new AtencionProfesionalesPaquete;
             $paquetesatencion->id_atencion =$atencion->id;
             $paquetesatencion->id_paquete    =$value;
             $paquetesatencion->id_servicio    =$id_servicio;
             $paquetesatencion->id_profesional =$request->profesional;
             $paquetesatencion->porcentajepaq =$request->porcentajepaq;
             $paquetesatencion->costo = $request->costo;
             $paquetesatencion->pagar = ($request->costo*$request->porcentajepaq)/100;
             $paquetesatencion->id_sucursal =$usuarioSuc;
             $paquetesatencion->id_empresa =$usuarioEmp;
             $paquetesatencion->save();

               $atenciondetalle = new AtencionDetalle;
       $atenciondetalle->id_atencion     =$atencion->id;
       $atenciondetalle->id_paciente     =$request->pacientes;
       $atenciondetalle->costo           =$request->preciototal;
       $atenciondetalle->origen           =$request->origen_paciente;
       $atenciondetalle->id_profesional =$request->profesional;
       $atenciondetalle->acuenta         =$request->acuenta;
       $atenciondetalle->costoa          =$request->costoa;
       $atenciondetalle->pendiente       =($request->preciototal-$request->costoa);
       $atenciondetalle->tarjeta         =$request->tarjeta;
       $atenciondetalle->porcentaje      =$request->porcentaje;
       $atenciondetalle->observaciones   =$request->observaciones;
       $atenciondetalle->save();
         }
        }

        $searchLabPaq = DB::table('paquetes_analises')
        ->select('*')
        ->where('id_paquete','=', $value)
        ->get();

         foreach ($searchLabPaq as $lab) {
            $id_laboratorio = $lab->id_analisis;


            if(! is_null($id_laboratorio)){

               $paquetesatencion = new AtencionProfesionalesPaqueteLab;
               $paquetesatencion->id_atencion =$atencion->id;
               $paquetesatencion->id_paquete    =$value;
               $paquetesatencion->id_laboratorio    =$id_laboratorio;
               $paquetesatencion->id_profesional =$request->profesional;
               $paquetesatencion->porcentajepaq =$request->porcentajepaq;
               $paquetesatencion->costo = $request->costo;
               $paquetesatencion->pagadolab = 0;
               $paquetesatencion->pagar = ($request->costo*$request->porcentajepaq)/100;
               $paquetesatencion->id_sucursal =$usuarioSuc;
               $paquetesatencion->id_empresa =$usuarioEmp;
               $paquetesatencion->save();

                 $atenciondetalle = new AtencionDetalle;
       $atenciondetalle->id_atencion     =$atencion->id;
       $atenciondetalle->id_paciente     =$request->pacientes;
       $atenciondetalle->costo           =$request->preciototal;
       $atenciondetalle->origen           =$request->origen_paciente;
       $atenciondetalle->id_profesional =$request->profesional;
       $atenciondetalle->acuenta         =$request->acuenta;
       $atenciondetalle->costoa          =$request->costoa;
       $atenciondetalle->pendiente       =($request->preciototal-$request->costoa);
       $atenciondetalle->tarjeta         =$request->tarjeta;
       $atenciondetalle->porcentaje      =$request->porcentaje;
       $atenciondetalle->observaciones   =$request->observaciones;
       $atenciondetalle->save();
         }
        }


}
}


    if(! is_null($request->analises)){
     $analisisatencion = new AtencionLaboratorio;
     $analisisatencion->id_atencion =$atencion->id;
     $analisisatencion->id_analisis    =0;
     $analisisatencion->origen    ='Laboratorios';
     $analisisatencion->id_profesional =$request->profesional;
     $analisisatencion->porcentaje =$request->porcentajelab;
     $analisisatencion->montolab = $request->preciopublico;
     $analisisatencion->id_sucursal =$usuarioSuc;
     $analisisatencion->id_empresa =$usuarioEmp;
     $analisisatencion->save();
     foreach ($request->analises as $key => $value) {


        $searchLab = DB::table('analises')
        ->select('*')
                   // ->where('estatus','=','1')
        ->where('id','=', $value)
        ->get();

        foreach ($searchLab as $lab) {
            $precio = $lab->preciopublico;

        }

         $atenciondetalle = new AtencionDetalle;
       $atenciondetalle->id_atencion     =$atencion->id;
       $atenciondetalle->id_paciente     =$request->pacientes;
       $atenciondetalle->costo           =$request->preciototal;
       $atenciondetalle->origen           =$request->origen_paciente;
       $atenciondetalle->id_profesional =$request->profesional;
       $atenciondetalle->acuenta         =$request->acuenta;
       $atenciondetalle->costoa          =$request->costoa;
       $atenciondetalle->pendiente       =($request->preciototal-$request->costoa);
       $atenciondetalle->tarjeta         =$request->tarjeta;
       $atenciondetalle->porcentaje      =$request->porcentaje;
       $atenciondetalle->observaciones   =$request->observaciones;
       $atenciondetalle->save();


        $serviciosproflab = new AtencionProfesionalesLaboratorio;
        $serviciosproflab->id_atencion =$atencion->id;
        $serviciosproflab->id_laboratorio    =$value;
        $serviciosproflab->id_profesional =$request->profesional;
        $serviciosproflab->porcentaje =$request->porcentajelab;
        $serviciosproflab->montolab = $request->preciopublico;
        $serviciosproflab->pagar = ($precio*$request->porcentajelab)/100;
        $serviciosproflab->id_sucursal =$usuarioSuc;
        $serviciosproflab->id_empresa =$usuarioEmp;
               //$serviciosproflab->id_atec_lab =$analisisatencion->id;
        $serviciosproflab->save();
    }
}
} else {

     if(! is_null($request->servicios)){

           $serviciosatencion = new AtencionServicios;
           $serviciosatencion->id_atencion =$atencion->id;
           $serviciosatencion->id_servicio    =0;
           $serviciosatencion->origen    ='Servicios';
           $serviciosatencion->id_profesional =999;
           $serviciosatencion->porcentaje =$request->porcentajeserv;
           $serviciosatencion->montoser = $request->precioserv;
           $serviciosatencion->id_sucursal =$usuarioSuc;
           $serviciosatencion->id_empresa =$usuarioEmp;
           $serviciosatencion->save();
           foreach ($request->servicios as $key => $value) {

            $searchServ = DB::table('servicios')
            ->select('*')
                   // ->where('estatus','=','1')
            ->where('id','=', $value)
            ->get();

            foreach ($searchServ as $servicios) {
                $precio = $servicios->precio;

            }


            $serviciosprofatencion = new AtencionProfesionalesServicio;
            $serviciosprofatencion->id_atencion =$atencion->id;
            $serviciosprofatencion->id_servicio    =$value;
            $serviciosprofatencion->id_profesional =999;
            $serviciosprofatencion->porcentaje =$request->porcentajeserv;
            $serviciosprofatencion->montoser = $request->precioserv;
            $serviciosprofatencion->pagar = ($precio*$request->porcentajeserv)/100;
            $serviciosprofatencion->id_sucursal =$usuarioSuc;
            $serviciosprofatencion->id_empresa =$usuarioEmp;
                //$serviciosprofatencion->id_atec_servicio =$serviciosatencion->id;
            $serviciosprofatencion->save();
        }
    }


    if(! is_null($request->analises)){
     $analisisatencion = new AtencionLaboratorio;
     $analisisatencion->id_atencion =$atencion->id;
     $analisisatencion->id_analisis    =0;
     $analisisatencion->origen    ='Laboratorios';
     $analisisatencion->id_profesional =999;
     $analisisatencion->porcentaje =$request->porcentajelab;
     $analisisatencion->montolab = $request->preciopublico;
     $analisisatencion->id_sucursal =$usuarioSuc;
     $analisisatencion->id_empresa =$usuarioEmp;
     $analisisatencion->save();
     foreach ($request->analises as $key => $value) {


        $searchLab = DB::table('analises')
        ->select('*')
                   // ->where('estatus','=','1')
        ->where('id','=', $value)
        ->get();

        foreach ($searchLab as $lab) {
            $precio = $lab->preciopublico;

        }


        $serviciosproflab = new AtencionProfesionalesLaboratorio;
        $serviciosproflab->id_atencion =$atencion->id;
        $serviciosproflab->id_laboratorio    =$value;
        $serviciosproflab->id_profesional =999;
        $serviciosproflab->porcentaje =$request->porcentajelab;
        $serviciosproflab->montolab = $request->preciopublico;
        $serviciosproflab->pagar = ($precio*$request->porcentajelab)/100;
        $serviciosproflab->id_sucursal =$usuarioSuc;
        $serviciosproflab->id_empresa =$usuarioEmp;
               //$serviciosproflab->id_atec_lab =$analisisatencion->id;
        $serviciosproflab->save();
    }
}


     $atenciondetalle = new AtencionDetalle;
       $atenciondetalle->id_atencion     =$atencion->id;
       $atenciondetalle->id_paciente     =$request->pacientes;
       $atenciondetalle->costo           =$request->preciototal;
       $atenciondetalle->origen           =$request->origen_paciente;
       $atenciondetalle->id_profesional =999;
       $atenciondetalle->acuenta         =$request->acuenta;
       $atenciondetalle->costoa          =$request->costoa;
       $atenciondetalle->pendiente       =($request->preciototal-$request->costoa);
       $atenciondetalle->tarjeta         =$request->tarjeta;
       $atenciondetalle->porcentaje      =$request->porcentaje;
       $atenciondetalle->observaciones   =$request->observaciones;
       $atenciondetalle->save();

 if(! is_null($request->paquetes)){
     foreach ($request->paquetes as $key => $value) {

        $searchServPaq = DB::table('paquetes_servs')
        ->select('*')
                   // ->where('estatus','=','1')
        ->where('id_paquete','=', $value)
        ->get();

        foreach ($searchServPaq as $serv) {
            $id_servicio = $serv->id_servicio;


            if(! is_null($id_servicio)){

             $paquetesatencion = new AtencionProfesionalesPaquete;
             $paquetesatencion->id_atencion =$atencion->id;
             $paquetesatencion->id_paquete    =$value;
             $paquetesatencion->id_servicio    =$id_servicio;
             $paquetesatencion->id_profesional =999;
             $paquetesatencion->porcentajepaq =$request->porcentajepaq;
             $paquetesatencion->costo = $request->costo;
             $paquetesatencion->pagar = ($request->costo*$request->porcentajepaq)/100;
             $paquetesatencion->id_sucursal =$usuarioSuc;
             $paquetesatencion->id_empresa =$usuarioEmp;
             $paquetesatencion->save();
         }
        }

        $searchLabPaq = DB::table('paquetes_analises')
        ->select('*')
        ->where('id_paquete','=', $value)
        ->get();

         foreach ($searchLabPaq as $lab) {
            $id_laboratorio = $lab->id_analisis;


            if(! is_null($id_laboratorio)){

               $paquetesatencion = new AtencionProfesionalesPaqueteLab;
               $paquetesatencion->id_atencion =$atencion->id;
               $paquetesatencion->id_paquete    =$value;
               $paquetesatencion->id_laboratorio    =$id_laboratorio;
               $paquetesatencion->id_profesional =999;
               $paquetesatencion->pagadolab = 0;
               $paquetesatencion->porcentajepaq =$request->porcentajepaq;
               $paquetesatencion->costo = $request->costo;
               $paquetesatencion->pagar = ($request->costo*$request->porcentajepaq)/100;
               $paquetesatencion->id_sucursal =$usuarioSuc;
               $paquetesatencion->id_empresa =$usuarioEmp;
               $paquetesatencion->save();
         }
        }


}
}

      

}


       $creditos = new Creditos;
       $creditos->id_atencion    =$atencion->id;
       $creditos->monto          =$request->costoa;
       $creditos->tipo_ingreso   =$request->acuenta;
       $creditos->origen          ='INGRESO DE ATENCIONES';
       $creditos->id_empresa     =$usuarioEmp;
       $creditos->id_sucursal    =$usuarioSuc;
       $creditos->save();


       
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

                /**servicios*/
                $servicioIds = [];
                $dat_servicios = AtencionProfesionalesServicio::where('id_atencion',$id)->get();
                //dd( $dat_servicios);
                foreach($dat_servicios as $value)
                {
                    $servicioIds[] = $value->id_servicio;
                }
                $servicios = Servicios::where('id_empresa',$usuarioEmp)
                ->where('id_sucursal',$usuarioSuc)->get();

                $analisisIds = [];
                $dat_analisis = AtencionProfesionalesLaboratorio::where('id_atencion',$id)->get();
                //dd( $dat_servicios);
                foreach($dat_analisis as $value)
                {
                    $analisisIds[] = $value->id_laboratorio;
                }
                /*$dat_seanalisis = Servicios::where('id_empresa',$usuarioEmp)
                ->where('id_sucursal',$usuarioSuc)->get();*/
       $analisis = Analisis::where('id_empresa',$usuarioEmp)
                             ->where('id_sucursal',$usuarioSuc)
                             ->get();

       $paquetes = Paquetes::where('id_empresa',$usuarioEmp)
                             ->where('id_sucursal',$usuarioSuc)
                             ->get()->pluck('name','id');
       $personal = Personal::where('id_empresa',$usuarioEmp)
                             ->where('id_sucursal',$usuarioSuc)
                             ->get()->pluck('name','id');
       $pacientes = Pacientes::where('id_empresa',$usuarioEmp)
                             ->where('id_sucursal',$usuarioSuc)
                             ->get()->pluck('dni','id');

       $profesional = Profesionales::select(
            DB::raw("CONCAT(name,' ',apellidos) AS descripcion"),'id')
           
       ->where('id_empresa',$usuarioEmp)
                             ->where('id_sucursal',$usuarioSuc)
                             ->get()->pluck('descripcion','id');

        

        return view('existencias.atencion.update', compact('servicios','personal','pacientes','profesional','analisis','paquetes','servicioIds','analisisIds'));
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
      

       // $atencion=Atencion::find($id)->delete();
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
