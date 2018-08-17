<?php
namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Silber\Bouncer\Database\HasRolesAndAbilities;
use Hash;

/**
 * Class Paquetes
 *
 * @package App
 * @property string $name


*/
class Paquetes extends Authenticatable
{
    use Notifiable;
    use HasRolesAndAbilities;

    protected $fillable = ['name','costo'];
    public function selectPaquete($id)
    {

        $array='';
        $data = \DB::table('paquetes')
        ->select('*')
                   // ->where('estatus','=','1')
        ->where('id', $id)
        ->first();
        //dd($data);
        if (isset($data->name)) {
        	$array=$data->name;
        } else {
        	$array=0;
        	
        }
        
      

    return $array;
              //  return $id;
}

   public function selectAllPaquetes($id)
    {

        $array='';
        $data = \DB::table('atencion_paquetes')
        ->select('*')
                   // ->where('estatus','=','1')
        ->where('id_atencion', $id)
        ->get();
        $descripcion='';
        
        
        foreach ($data as $key => $value) {

            $datapaquetes = \DB::table('paquetes')
            ->select('*')
            ->where('id', $value->id_paquete)
            ->get();

        foreach ($datapaquetes as $keydataanalisis => $valuedataanalisis) {
                $descripcion.= $valuedataanalisis->name.',';
                          # code...
            }
        }  
        return substr($descripcion, 0, -1);  
    }
    
}
