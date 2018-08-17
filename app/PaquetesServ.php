<?php
namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Silber\Bouncer\Database\HasRolesAndAbilities;
use Hash;

/**
 * Class PaquetesServ
 *
 * @package App
 * @property string $id_paquete
 * @property string $id_servicio

*/
class PaquetesServ extends Authenticatable
{
    use Notifiable;
    use HasRolesAndAbilities;

    protected $fillable = ['name','costo'];
    
     public function selectAllServicios($id)
    {

        $array='';
        $data = \DB::table('paquetes_servs')
        ->select('*')
                   // ->where('estatus','=','1')
        ->where('id_paquete', $id)
        ->get();
        $descripcion='';
        
        
        foreach ($data as $key => $value) {

          $dataservicio = \DB::table('servicios')
          ->select('*')
          ->where('id', $value->id_servicio)
          ->get();
          foreach ($dataservicio as $key => $valueservicio) {
            $descripcion.= $valueservicio->detalle.',';
                          # code...
        }
    }

    return substr($descripcion, 0, -1);
              //  return $id;
}
   
    
}
