<?php
namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Silber\Bouncer\Database\HasRolesAndAbilities;
use Hash;

/**
 * Class Medidas
 *
 * @package App
 * @property string $nombre
 * @property string $referencia
 * @property string $direccion
*/
class Medidas extends Authenticatable
{
    use Notifiable;
    use HasRolesAndAbilities;

    protected $fillable = ['nombre'];
   
    
}
