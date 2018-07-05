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
 * @property string $nombres
 * @property string $apellidos
 * @property string $especialidad
 * @property string $centro
 * @property string $cmp
 * @property string $nacimiento
*/

class Profesionales extends Authenticatable
{
    use Notifiable;
    use HasRolesAndAbilities;

    protected $fillable = ['nombres', 'apellidos', 'especialidad', 'centro', 'cmp', 'nacimiento'];
    
    
    /**
     * Hash password
     * @param $input
     */
    public function setPasswordAttribute($input)
    {
        if ($input)
            $this->attributes['password'] = app('hash')->needsRehash($input) ? Hash::make($input) : $input;
    }
    
    
    public function role()
    {
        return $this->belongsToMany(Role::class, 'role_user');
    }
    
    
    
}
