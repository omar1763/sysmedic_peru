<?php

namespace App\Http\Controllers\Existencias;
use App\Atencion;
use App\AtencionLaboratorio;
use App\Creditos;
use App\AtencionDetalle;
use App\Locales;
use App\Empresas;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\Movimientos\StoreResultadosRequest;
use App\Http\Requests\Movimientos\UpdateResultadosRequest;

class CuentasporCobrarController extends Controller
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
         
         


                     $cuentasporcobrar = DB::table('atencion_detalles as a')
                    ->select('b.id','b.id_empresa','b.created_at as fecha','b.id_sucursal','a.id_atencion','a.id_paciente','a.costo','a.costoa','a.pendiente','a.pagado','a.created_at','c.nombres as nombres','c.apellidos as apellidos')
                    ->join('atencions as b','b.id','a.id_atencion')
                    ->join('pacientes as c','c.id','a.id_paciente')
                    ->where('b.id_empresa','=', $usuarioEmp)
                    ->where('b.id_sucursal','=', $usuarioSuc)
                  //  ->where('a.pagado','=', 0)
                    ->where('a.pendiente','>', 0)
                   // ->where('a.created_at','=', $f1)
                    //->whereDate('a.created_at', '=', Carbon::now()->format('Y-m-d'))
                    ->groupBy('b.id')
                    ->orderby('a.created_at','desc')
                    ->paginate(500);


        return view('existencias.cuentasporcobrar.index', compact('cuentasporcobrar'));
    }


    
   public function pagar($id)

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



                  /*   $cuentasporcobrar = DB::table('atencion_detalles as a')
                    ->select('b.id','b.id_empresa','b.created_at as fecha','b.id_sucursal','a.id_atencion','a.id_paciente','a.costo','a.costoa','a.pendiente','a.pagado','a.created_at','c.nombres as nombres','c.apellidos as apellidos')
                    ->join('atencions as b','b.id','a.id_atencion')
                    ->join('pacientes as c','c.id','a.id_paciente')
                    ->where('b.id_empresa','=', $usuarioEmp)
                    ->where('b.id_sucursal','=', $usuarioSuc)
                    ->where('a.pagado','=', 0)
                    ->where('a.pendiente','>', 0)
                    ->where('a.id_atencion','=',$id)
                   // ->where('a.created_at','=', $f1)
                    //->whereDate('a.created_at', '=', Carbon::now()->format('Y-m-d'))
                    ->orderby('a.created_at','desc')
                    ->get();*/

                    $cuentasporcobrar = Atencion::findOrFail($id);

                    $pagar = DB::table('atencion_detalles')
                    ->select('pendiente')
                   // ->where('estatus','=','1')
                    ->where('id_atencion','=', $id)
                    ->pluck('pendiente')->first();

        return view('existencias.cuentasporcobrar.pagar',compact('cuentasporcobrar','pagar'));
    }
  


      public function destroy(Request $request,$id)
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
      
        $searchAtenciondetalles = DB::table('atencion_detalles')
                    ->select('*')
                   // ->where('estatus','=','1')
                    ->where('id_atencion','=', $id)
                    ->get();

                

            foreach ($searchAtenciondetalles as $detalles) {
                    $montoDetalle = $detalles->pendiente;
                    $idDetalle = $detalles->id;
                    $id_atencion = $detalles->id_atencion;
                    $pendiente= $detalles->pendiente;
                 
                }

        $cuenta = AtencionDetalle::findOrFail($idDetalle);
        $cuenta->pagado = 1;
        $cuenta->pendiente = $pendiente - $request->pagar;
        $cuenta->update();

        $creditos = new Creditos;
        $creditos->descripcion ='CUENTAS POR COBRAR';
        $creditos->monto     =$request->pagar;
        $creditos->id_atencion =$id_atencion;
        $creditos->origen     ='CUENTAS POR COBRAR';
        $creditos->tipo_ingreso ='EF';
        $creditos->causa ='CC';
        $creditos->id_empresa     =$usuarioEmp;
        $creditos->id_sucursal     =$usuarioSuc;
        $creditos->save();


        return redirect()->route('admin.cuentasporcobrar.index');
    }

}

