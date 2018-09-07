<?php
namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Silber\Bouncer\Database\HasRolesAndAbilities;
use Hash;
use App\Pacientes;

/**
 * Class AtencionDetalle
 *
 * @package App
 * @property string $id_paciente
 * @property string $id_servicio
 * @property string $costo
 * @property string $porcentaje
 * @property string $acuenta
 * @property string $observaciones

*/
class AtencionDetalle extends Authenticatable
{
    use Notifiable;
    use HasRolesAndAbilities;

    protected $fillable = ['id_paciente','id_servicio','costo','porcentaje','acuenta','observaciones'];
    public function selectPaciente($id)
    {

        
        $data = \DB::table('pacientes')
        ->select('*')
                   // ->where('estatus','=','1')
        ->where('id', $id)->first();
        
        $descripcion=$data->nombres.' '.$data->apellidos;
        
         
      

    return $descripcion;
              //  return $id;
}

  public function selectProfesional($id)
    {

        
        $data = \DB::table('profesionales')
        ->select('*')
                   // ->where('estatus','=','1')
        ->where('id', $id)->first();
        
        $descripcion=$data->name.' '.$data->apellidos;
        
         
      

    return $descripcion;
              //  return $id;
}
   
    
}
