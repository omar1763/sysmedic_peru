<?php
namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Silber\Bouncer\Database\HasRolesAndAbilities;
use Hash;
use DB;

/**
 * Class Locales
 *
 * @package App
 * @property string $nombre
 * @property string $id_empresa

*/
class Locales extends Authenticatable
{
    use Notifiable;
    use HasRolesAndAbilities;

    protected $fillable = ['nombres','id_empresa'];


      public static function locbyemp($id){
                $locales = DB::table('locales as a')
                ->select('a.nombres','a.id','a.id_empresa')
                     ->where('a.id_empresa','=', $id)
                     ->get()->pluck('nombres','id');

         if(!is_null($locales)){
            return $locales;
         }else{
            return false;
         }

    }
  
    
    
}
