<?php
namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Silber\Bouncer\Database\HasRolesAndAbilities;
use Hash;

/**
 * Class Analisis
 *
 * @package App
 * @property string $name
 * @property string $laboratorio
 * @property string $preciopublico
 * @property string $porcentaje
 * @property string $costlab
*/
class Analisis extends Authenticatable
{
    use Notifiable;
    use HasRolesAndAbilities;

    protected $fillable = ['name','laboratorio','preciopublico','porcentaje','costlab'];
   
    
}
