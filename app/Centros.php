<?php
namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Silber\Bouncer\Database\HasRolesAndAbilities;
use Hash;

/**
 * Class Centrosmedicos
 *
 * @package App
 * @property string $name
 * @property string $referencia
 * @property string $direccion
 * @property string $codigo
*/
class Centros extends Authenticatable
{
    use Notifiable;
    use HasRolesAndAbilities;

    protected $fillable = ['name', 'direccion', 'referencia','codigo'];
    
    
   
    
    
}
