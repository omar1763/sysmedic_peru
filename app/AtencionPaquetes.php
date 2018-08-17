<?php
namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Silber\Bouncer\Database\HasRolesAndAbilities;
use Hash;

/**
 * Class AtencionPaquetes
 *
 * @package App
 * @property string $id_atencion
 * @property string $id_paquete
 
*/
class AtencionPaquetes extends Authenticatable
{
    use Notifiable;
    use HasRolesAndAbilities;

    protected $fillable = ['id_atencion','id_paquete'];
   
    
}
