<?php
namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Silber\Bouncer\Database\HasRolesAndAbilities;
use Hash;
use DB;

/**
 * Class Distrito
 *
 * @package App
 * @property string $nombre

*/
class Distrito extends Authenticatable
{
    use Notifiable;
    use HasRolesAndAbilities;

    protected $fillable = ['nombre'];


    public static function distbypro($id){
                $distritos = DB::table('distritos as a')
                ->select('a.nombre')
                     ->where('a.id_provincia','=', $id)
                     ->get()->pluck('nombre');

         if(!is_null($distritos)){
            return $distritos;
         }else{
            return false;
         }

    }
  
    
    
}
