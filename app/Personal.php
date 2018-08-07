<?php
namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Silber\Bouncer\Database\HasRolesAndAbilities;
use Hash;

/**
 * Class Personal
 *
 * @package App
 * @property string $name
 * @property string $apellidos
 * @property string $dni
 * @property string $telefono
 * @property string $email
 * @property string $direccion
*/
class Personal extends Authenticatable
{
    use Notifiable;
    use HasRolesAndAbilities;

    protected $fillable = ['name', 'apellidos', 'dni','email', 'telefono','direccion'];
    
        
    
}
