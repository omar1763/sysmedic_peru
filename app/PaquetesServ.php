<?php
namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Silber\Bouncer\Database\HasRolesAndAbilities;
use Hash;

/**
 * Class PaquetesServ
 *
 * @package App
 * @property string $id_paquete
 * @property string $id_servicio

*/
class PaquetesServ extends Authenticatable
{
    use Notifiable;
    use HasRolesAndAbilities;

    protected $fillable = ['name','costo'];
   
    
}
