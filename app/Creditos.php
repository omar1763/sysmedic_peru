<?php
namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Silber\Bouncer\Database\HasRolesAndAbilities;
use Hash;

/**
 * Class Creditos
 *
 * @package App
 * @property string $id_atencion
 * @property string $monto
 * @property string $descripcion

*/
class Creditos extends Authenticatable
{
    use Notifiable;
    use HasRolesAndAbilities;

    protected $fillable = ['id_atencion','monto','descripcion'];
    
   
    
}
