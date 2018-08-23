<?php
namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Silber\Bouncer\Database\HasRolesAndAbilities;
use Hash;

/**
 * Class Servicios
 *
 * @package App
 * @property string $detalle
 * @property string $precio
 * @property string $porcentaje
*/
class Servicios extends Authenticatable
{
    use Notifiable;
    use HasRolesAndAbilities;

    protected $fillable = ['detalle', 'precio', 'porcentaje'];
    
    
    /**
     * Hash password
     * @param $input
     */
    public function setPasswordAttribute($input)
    {
        if ($input)
            $this->attributes['password'] = app('hash')->needsRehash($input) ? Hash::make($input) : $input;
    }
    public function selectAllServicios($id)
    {

        $array='';
        $data = \DB::table('atencion_profesionales_servicios')
        ->select('*')
                   // ->where('estatus','=','1')
        ->where('id_atencion', $id)
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
