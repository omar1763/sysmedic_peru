<?php

namespace App\Http\Controllers;


use Carbon\Carbon;
use DB;
use Illuminate\Support\Facades\Auth;
use Silber\Bouncer\Database\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Movimientos\StoreAtencionRequest;
use App\Http\Requests\Movimientos\UpdateAtencionRequest;

class JjmaController extends Controller
{
    /**
     * Display a listing of User.
     *
     * @return \Illuminate\Http\Response
     */
    public function selectproducto()
    {
        if (! Gate::allows('users_manage')) {
            return abort(401);
        }
        $product = DB::table('productos')
               // ->where('clvregion' , $id)
                
              /*->where([
                    ['clvregion', '=', $id],
                    ['blnborrado', '=', true]
             
                ])*/
                ->get()
                ->pluck('name', 'id');

       
      return view("existencias.otrosingresos.selectprodut",['product'=>$product]);
    }
     

      


}
