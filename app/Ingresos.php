<?php
namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Silber\Bouncer\Database\HasRolesAndAbilities;
use Hash;

/**
 * Class Ingresos
 *
 * @package App
 * @property string $producto
 * @property string $cantidad
 * @property string $fechaingreso

*/
class Ingresos extends Authenticatable
{
    use Notifiable;
    use HasRolesAndAbilities;

    protected $fillable = ['producto','cantidad','fechaingreso'];
  
    
    
}
