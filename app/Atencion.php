<?php
namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Silber\Bouncer\Database\HasRolesAndAbilities;
use Hash;

/**
 * Class Atencion
 *
 * @package App
 * @property string $id_empresa
 * @property string $id_sucursal

*/
class Atencion extends Authenticatable
{
    use Notifiable;
    use HasRolesAndAbilities;

    protected $fillable = ['id_empresa','id_sucursal'];
   
    
}
