<?php
namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Silber\Bouncer\Database\HasRolesAndAbilities;
use Hash;

/**
 * Class Provincia
 *
 * @package App
 * @property string $nombre

*/
class CreditosProductos extends Authenticatable
{
    use Notifiable;
    use HasRolesAndAbilities;

    protected $fillable = ['id_credito','id_producto'];
     public function selectAllProductos($id)
    {

        $array='';
        $data = \DB::table('creditos_productos')
        ->select('*')
                   // ->where('estatus','=','1')
        ->where('id_credito', $id)
        ->get();
        $descripcion='';
        $cantidad='';

         foreach ($data as $datacredito) {
                    $cantidadCredito = $datacredito->cantidad;   
                }

        
        
        foreach ($data as $key => $value) {

          $dataproductos = \DB::table('productos')
          ->select('*')
          ->where('id', $value->id_producto)
          ->get();

          foreach ($dataproductos as $keydataproductos => $valuedataproductos) {
            $descripcion.= $valuedataproductos->name.'-> Cantidad:'.$cantidadCredito.',';
           // $cantidad.= $valuedataproductos->cantidad.',';
                          # code...
        }
    }

    return substr($descripcion, 0, -1);
              //  return $id;
}
  
    
    
}
