<?php
namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Silber\Bouncer\Database\HasRolesAndAbilities;
use Hash;

/**
 * Class Gastos
 *
 * @package App
 * @property string $name
 * @property string $concepto
 * @property string $monto

*/
class Gastos extends Authenticatable
{
    use Notifiable;
    use HasRolesAndAbilities;

    protected $fillable = ['name','concepto','monto'];
   
    
}
