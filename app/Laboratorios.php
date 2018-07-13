<?php
namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Silber\Bouncer\Database\HasRolesAndAbilities;
use Hash;

/**
 * Class Profesionales
 *
 * @package App
 * @property string $name
 * @property string $direccion
 * @property string $referencia


*/

class Laboratorios extends Authenticatable
{
    use Notifiable;
    use HasRolesAndAbilities;

    protected $fillable = ['name', 'direccion', 'referencia'];
    
    

    
    
}
