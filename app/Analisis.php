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
 * @property string $name
 * @property string $laboratorio
 * @property string $preciopublico
 * @property string $porcentaje
 * @property string $costlab
*/
class Analisis extends Authenticatable
{
    use Notifiable;
    use HasRolesAndAbilities;

    protected $fillable = ['name','laboratorio','preciopublico','porcentaje','costlab'];
   
        public function selectAllAnalisis($id)
    {

    	$array='';
    	$data = \DB::table('atencion_laboratorios')
    	->select('*')
                   // ->where('estatus','=','1')
    	->where('id_atencion', $id)
    	->get();
    	$descripcion='';
    	
    	
    	foreach ($data as $key => $value) {

    		$dataanalisis = \DB::table('analises')
    		->select('*')
    		->where('id', $value->id_analisis)
    		->get();

    	foreach ($dataanalisis as $keydataanalisis => $valuedataanalisis) {
    			$descripcion.= $valuedataanalisis->name.',';
                          # code...
    		}
    	}  
    	return substr($descripcion, 0, -1);  
    }
}
