<?php
namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Silber\Bouncer\Database\HasRolesAndAbilities;
use Hash;

/**
 * Class Productos
 *
 * @package App
 * @property string $nombre
 * @property string $medida
 * @property string $cantidad

*/
class Productos extends Authenticatable
{
    use Notifiable;
    use HasRolesAndAbilities;

    protected $fillable = ['nombre', 'medida', 'cantidad'];
    
}
