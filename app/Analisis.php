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
 * @property string $nombre
 * @property string $laboratorio
 * @property string $preciopublico
 * @property string $costlab

*/
class Analisis extends Authenticatable
{
    use Notifiable;
    use HasRolesAndAbilities;

    protected $fillable = ['nombre', 'laboratorio', 'preciopublico','costlab'];
    

   
    
    
}
