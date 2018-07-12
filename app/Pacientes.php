<?php
namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Silber\Bouncer\Database\HasRolesAndAbilities;
use Hash;

/**
 * Class Pacientes
 *
 * @package App
 * @property string $dni
 * @property string $nombres
 * @property string $apellidos
 * @property string $direccion
 * @property string $provincia
 * @property string $distrito
 * @property string $telefono
 * @property string $fechanac
 * @property string $gradoinstruccion
 * @property string $ocupacion
 * @property string $edocivil
 * @property string $historia
*/

class Pacientes extends Authenticatable
{
    use Notifiable;
    use HasRolesAndAbilities;

    protected $fillable = ['dni','nombres','apellidos','direccion','distrito','telefono','fechanac','gradoinstruccion','ocupacion','edocivil','historia'];
  
    
    
}
