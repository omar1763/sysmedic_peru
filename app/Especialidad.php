<?php
namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Silber\Bouncer\Database\HasRolesAndAbilities;


/**
 * Class Especialidad
 *
 * @package App
 * @property string $nombre

*/
class Especialidad extends Authenticatable
{
    use Notifiable;
    use HasRolesAndAbilities;

    protected $fillable = ['nombre'];
    
    
  
    
 
    
    
}
