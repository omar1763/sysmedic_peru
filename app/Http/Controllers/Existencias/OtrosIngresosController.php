<?php

namespace App\Http\Controllers\Existencias;

use App\Gastos;
use App\Creditos;
use App\Empresas;
use App\CreditosProductos;
use App\Locales;
use App\Productos;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\Existencias\StoreOtrosIngresosRequest;
use App\Http\Requests\Existencias\UpdateOtrosIngresosRequest;

class OtrosIngresosController extends Controller
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

            $f1 = date('YYYY-m-d');

            if(! is_null($request->fecha)) {
                $f1 = $request->fecha;
                    $otrosingresos = DB::table('creditos as a')
                    ->select('a.id','a.id_atencion','a.descripcion','a.monto','a.origen','a.id_empresa','a.id_sucursal','a.created_at','a.tipo_ingreso','a.causa')
                    ->join('empresas as b','a.id_empresa','b.id')
                    ->join('locales as c','a.id_sucursal','c.id')
                    ->where('a.id_empresa','=', $usuarioEmp)
                    ->where('a.id_sucursal','=', $usuarioSuc)
                    ->where('a.origen','=','OTROS INGRESOS')
                    ->where('a.created_at','=', $f1)
                    ->orderby('a.created_at','desc')
                    ->paginate(10000);

            } else {

         $otrosingresos = DB::table('creditos as a')
        ->select('a.id','a.id_atencion','a.descripcion','a.monto','a.origen','a.tipo_ingreso','a.causa','a.id_empresa','a.id_sucursal','a.created_at')
        ->join('empresas as b','a.id_empresa','b.id')
        ->join('locales as c','a.id_sucursal','c.id')
        ->where('a.id_empresa','=', $usuarioEmp)
        ->where('a.id_sucursal','=', $usuarioSuc)
        ->where('a.origen','=','OTROS INGRESOS')
        ->whereDate('a.created_at', '=', Carbon::now()->format('Y-m-d'))
        ->orderby('a.created_at','desc')
        ->paginate(100000);
}
$creditosproductos = new CreditosProductos();
        return view('existencias.otrosingresos.index', compact('otrosingresos','creditosproductos'));
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

          $product = DB::table('productos')
               // ->where('clvregion' , $id)
                
              /*->where([
                    ['clvregion', '=', $id],
                    ['blnborrado', '=', true]
             
                ])*/
                ->where('id_empresa','=',$usuarioEmp)
                ->where('id_sucursal','=',$usuarioSuc)
                ->get()
                ->pluck('name', 'id');
 $relations = [            
            'product' => $product,
           
            
        ];
        return view('existencias.otrosingresos.create',$relations);
    }

    /**Ll
     * Store a newly created User in storage.
     *
     * @param  \App\Http\Requests\StoreUsersRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOtrosIngresosRequest $request)
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

       $otrosingresos = new Creditos;
       $otrosingresos->monto =$request->monto;
       $otrosingresos->descripcion     =$request->descripcion;
       $otrosingresos->origen     ='OTROS INGRESOS';
       $otrosingresos->tipo_ingreso     =$request->tipo_ingreso;
       $otrosingresos->causa     =$request->causa;
       $otrosingresos->id_empresa= $usuarioEmp;
       $otrosingresos->id_sucursal =$usuarioSuc;
       $otrosingresos->save();

       if (!is_null($request->product[0])) {
        foreach ($request->product as $data) {
            $creditosproductos = new CreditosProductos();
            $creditosproductos->id_producto = $data;
            $creditosproductos->id_credito = $otrosingresos->id;
            $creditosproductos->cantidad = $request->cant;
            $creditosproductos->save();

            $searchproducID = DB::table('productos')
                    ->select('*')
                   // ->where('estatus','=','1')
                    ->where('id','=', $request->product)
                    ->get();

            foreach ($searchproducID as $prod) {
                       $id_producto = $prod->id;
                      $nombreprod = $prod->name;
                     $cantidadprod = $prod->cantidad;
                }

              //  $venta = 1;

               
                $productos=Productos::where('id', '=' , $id_producto)->get()->first();
                $productos->cantidad=$cantidadprod - $request->cant;
                $productos->update();


            //dd($data);
        }

    } 

       


        return redirect()->route('admin.otrosingresos.index');
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


        $otrosingresos = Creditos::findOrFail($id);

        return view('existencias.otrosingresos.edit', compact('otrosingresos'));

    }

    public function update(UpdateOtrosIngresosRequest $request, $id)

    {
        if (! Gate::allows('users_manage')) {
            return abort(401);
        }
        $otrosingresos = Creditos::findOrFail($id);
        $otrosingresos->update($request->all());
       
        return redirect()->route('admin.otrosingresos.index');
    }


   
    public function destroy($id)
    {

        $creditos = Creditos::findOrFail($id);
        $creditos->delete();



        $searchcreditoID = DB::table('creditos_productos')
        ->select('*')
                   // ->where('estatus','=','1')
        ->where('id_credito','=',$id)
        ->get();

        foreach ($searchcreditoID as $cred) {
         $id_credito = $cred->id;
         $id_producto = $cred->id_producto;
         $cantidad = $cred->cantidad;
     }
     

     $searchproducID = DB::table('productos')
     ->select('*')
                   // ->where('estatus','=','1')
     ->where('id','=', $id_producto)
     ->get();

     foreach ($searchproducID as $prod) {
         $id_producto = $prod->id;
         $nombreprod = $prod->name;
         $cantidadprod = $prod->cantidad;
     }


     $creditosprod=CreditosProductos::findOrFail($id_credito);
     $creditosprod->delete();

     $productos=Productos::where('id', '=' , $id_producto)->get()->first();
     $productos->cantidad=$cantidadprod + $cantidad;
     $productos->update();


        return redirect()->route('admin.otrosingresos.index');
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
            $entries = Creditos::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }

}
