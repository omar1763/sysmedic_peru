<?php
namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Silber\Bouncer\Database\HasRolesAndAbilities;
use Hash;

/**
 * Class AtencionProfesionalesPaquete
 *
 * @package App
 * @property string $id_atencion
 * @property string $id_paquete
 * @property string $id_profesional
 * @property string $estatus
 
*/
class AtencionProfesionalesPaquete extends Authenticatable
{
    use Notifiable;
    use HasRolesAndAbilities;

    protected $fillable = ['id_atencion','id_paquete','id_profesional','estatus'];
   
    
}