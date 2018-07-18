<?php
namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Silber\Bouncer\Database\HasRolesAndAbilities;
use Hash;

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
   
    
}
