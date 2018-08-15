<?php

namespace App\Http\Controllers;


use Carbon\Carbon;
use DB;
use Illuminate\Support\Facades\Auth;
use Silber\Bouncer\Database\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;

use Elibyy\TCPDF\Facades\TCPDF;
use PDF;

class ReportesController extends Controller
{
    /**
     * Display a listing of User.
     *
     * @return \Illuminate\Http\Response
     */
     public function filtrogeneral()
    {
        if (! Gate::allows('users_manage')) {
            return abort(401);
        }


        return view('reportes.filtroreport1');
    }

    public function reportegeneral()
    {
        if (! Gate::allows('users_manage')) {
            return abort(401);
        }
      /*
        "desde" => "2018-08-16"
        "hasta" => "2018-08-16"
        "tipo_ingreso" => "EF"
        "origen" => "INGRESO DE ATENCIONES"
       */
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
$datos_usuario=" id_empresa=".$usuarioEmp." and id_sucursal=".$usuarioSuc." ";
       $desde = $_POST['desde'] !='' ? " and created_at >= '". $_POST['desde']."'"    : null ;
    $hasta = $_POST['hasta'] !='' ? " and created_at <= '". $_POST['hasta']."'"    : null ;
     $tipo_ingreso = $_POST['tipo_ingreso'] !='' ? " and tipo_ingreso = '".$_POST['tipo_ingreso']."' "    : null ;
    $origen = $_POST['origen'] !='' ? " and origen = '".$_POST['origen']."' "    : null;
    $sql=$datos_usuario.$desde.$hasta.$tipo_ingreso.$origen;
   // dd( $sql);
      $model=\DB::select("SELECT * from creditos
             where  ".$sql);
     /* $con=0;
      foreach ($model as $key => $value) {
        $con++;
          echo "Id".$value->id.'Recorrido:'.$con.'<br>';
      }
      exit();*/
$data=[
    'model'=>$model

];
      

$view = \View::make("reportes.report-1",$data);
$pdf = \App::make('dompdf.wrapper');
       //$pdf->loadHTML($view)->setPaper('letter', 'landscape');

$pdf->loadHTML($view)->setPaper('letter', 'portrait');$pdf->output();
/*$dom_pdf = $pdf->getDomPDF();

$canvas = $dom_pdf ->get_canvas();
$canvas->page_text(350, 550, "Page {PAGE_NUM} of {PAGE_COUNT}", null, 10, array(0, 0, 0));*/

       
        return $pdf->download('historiapaciente');
     // return view("reportes.report-1",$data);
    }
     

      


}
