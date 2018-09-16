<?php
namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Silber\Bouncer\Database\HasRolesAndAbilities;
use Silber\Bouncer\Database\Role;
use Illuminate\Support\Facades\Auth;
use DB;
use Hash;

/**
 * Class HistoriaPacientes
 *
 * @package App
 * @property string $historia
 * @property string $id_paciente


*/
class HistoriaPacientes extends Authenticatable
{
    use Notifiable;
    use HasRolesAndAbilities;

    protected $fillable = ['historia','id_paciente'];



    public static function generarHistoria(){
        
         $id_usuario = Auth::id();

         $searchUsuarioID = DB::table('users')
                    ->select('*')
                   // ->where('estatus','=','1')
                    ->where('id','=', $id_usuario)
                    ->get();

            foreach ($searchUsuarioID as $usuario) {
                    $usuarioEmp = $usuario->id_empresa;
                    $usuarioSuc = $usuario->id_sucursal;
                }

      
        $searchContador= DB::table('historia_pacientes')
                    ->select('*')
                    ->where('id_empresa','=',$usuarioEmp)
                    ->where('id_sucursal','=', $usuarioSuc)
                    ->get();

        $contador=1;
          if(count($searchContador) ==0){
            $contador=1;
          
            $historia = new HistoriaPacientes;
            $historia->historia=$contador;
            $historia->id_empresa=$usuarioEmp;
            $historia->id_sucursal=$usuarioSuc;
            $historia->save();

          
        } else {
         foreach ($searchContador as $correlativo){
            $contador=$correlativo->historia+1;

         
            $historia=HistoriaPacientes::findOrFail($correlativo->id);
            $historia->historia=$contador;
            $historia->updated_at=date('Y-m-d H:i:s');
            $historia->update();

        } 
    }

    return str_pad($contador, 4, "0", STR_PAD_LEFT);

    }
   
    
}
