<?php
namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Silber\Bouncer\Database\HasRolesAndAbilities;
use Hash;

/**
 * Class AtencionProfesionalesServicio
 *
 * @package App
 * @property string $id_atencion
 * @property string $id_servicio
 * @property string $id_profesional
 * @property string $estatus
 
*/
class AtencionProfesionalesServicio extends Authenticatable
{
    use Notifiable;
    use HasRolesAndAbilities;

    protected $fillable = ['id_atencion','id_servicio','id_profesional','estatus'];
   
    
}
