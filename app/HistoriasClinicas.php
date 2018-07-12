<?php
namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Silber\Bouncer\Database\HasRolesAndAbilities;
use Hash;

/**
 * Class HistoriasClinicas
 *
 * @package App
 * @property string $id_paciente
 * @property string $historia
 * @property string $estatus
s

*/
class HistoriasClinicas extends Authenticatable
{
    use Notifiable;
    use HasRolesAndAbilities;

    protected $fillable = ['id_paciente','historia','estatus'];
  
    
    
}
