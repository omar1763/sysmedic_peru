<?php
namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Silber\Bouncer\Database\HasRolesAndAbilities;
use Hash;

/**
 * Class AtencionProfesionalesPaqueteLab
 *
 * @package App
 * @property string $id_atencion
 * @property string $id_paquete
 * @property string $id_laboratorio
 * @property string $id_profesional
 * @property string $estatus
 
*/
class AtencionProfesionalesPaqueteLab extends Authenticatable
{
    use Notifiable;
    use HasRolesAndAbilities;

    protected $fillable = ['id_atencion','id_paquete','id_laboratorio','id_profesional','estatus'];
   
    
}