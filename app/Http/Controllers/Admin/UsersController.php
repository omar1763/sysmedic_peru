<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Empresas;
use App\Locales;
use DB;
use Silber\Bouncer\Database\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreUsersRequest;
use App\Http\Requests\Admin\UpdateUsersRequest;

class UsersController extends Controller
{
    /**
     * Display a listing of User.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('users_managefull')) {
            return abort(401);
        }

         $roles = User::with('roles')->get();

         $users = DB::table('users as a')
        ->select('a.id','a.name','a.email','b.nombre','c.nombres')
        ->join('empresas as b','a.id_empresa','b.id')
        ->join('locales as c','a.id_sucursal','c.id')
        ->orderby('a.created_at','desc')
        ->paginate(100000);
        //$users = User::with('roles')->get();

        return view('admin.users.index', compact('users','roles'));
    }

     public function locbyemp($id)
    {
      $locales = Locales::locbyemp($id);
        return view('admin.users.locbyemp', compact('locales'));
    }

    /**
     * Show the form for creating new User.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('users_managefull')) {
            return abort(401);
        }
        $roles = Role::get()->pluck('name', 'name');
        $empresas = Empresas::get()->pluck('nombre', 'id');

        return view('admin.users.create', compact('roles','empresas'));
    }

    public function dataUser() {
                   
         $id_usuario = Auth::id();

         $users = DB::table('users as a')
        ->select('a.id','a.name','a.email','b.nombre as empresa','c.nombres as sucursal')
        ->join('empresas as b','a.id_empresa','b.id')
        ->join('locales as c','a.id_sucursal','c.id')
        ->where('a.id','=',$id_usuario)
        ->orderby('a.created_at','desc')
        ->paginate(10);

      return view('partials.topbar', compact('users'));

    }
    /**
     * Store a newly created User in storage.
     *
     * @param  \App\Http\Requests\StoreUsersRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $empresas = DB::table('empresas as a')
        ->select('*')
        ->where('a.id','=',$request->empresas)
        ->get()->pluck('nombre'); 

        $locales = DB::table('locales as a')
        ->select('*')
        ->where('a.id','=',$request->locales)
        ->get()->pluck('nombres'); 


       $user = new User;
       $user->name =$request->name;
       $user->email     =$request->email;
       $user->password     =$request->password;
       $user->id_empresa     =$request->empresas;
       $user->id_sucursal     =$request->locales;
       $user->rol     =$request->rol;
       $user->empresa     =$empresas;
       $user->sucursal     =$locales;
       $user->save();


        foreach ($request->input('roles') as $role) {
            $user->assign($role);
        }

        return redirect()->route('admin.users.index');
    }


    /**
     * Show the form for editing User.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('users_managefull')) {
            return abort(401);
        }
        $roles = Role::get()->pluck('name', 'name');

        $user = User::findOrFail($id);

        $empresas = Empresas::get()->pluck('nombre', 'id');

        return view('admin.users.edit', compact('user', 'roles','empresas'));
    }

    /**
     * Update User in storage.
     *
     * @param  \App\Http\Requests\UpdateUsersRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUsersRequest $request, $id)
    {
        if (! Gate::allows('users_managefull')) {
            return abort(401);
        }
        

        $empresas = DB::table('empresas as a')
        ->select('*')
        ->where('a.id','=',$request->empresas)
        ->get()->pluck('nombre'); 

        $locales = DB::table('locales as a')
        ->select('*')
        ->where('a.id','=',$request->locales)
        ->get()->pluck('nombres'); 

       $user = User::findOrFail($id);
       $user->name =$request->name;
       $user->email     =$request->email;
       $user->password     =$request->password;
       $user->id_empresa     =$request->empresas;
       $user->id_sucursal     =$request->locales;
       $user->rol     =$request->rol;
       $user->empresa     =$empresas;
       $user->sucursal     =$locales;
       $user->update();

        foreach ($user->roles as $role) {
            $user->retract($role);
        }
        foreach ($request->input('roles') as $role) {
            $user->assign($role);
        }

        return redirect()->route('admin.users.index');
    }

    /**
     * Remove User from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('users_managefull')) {
            return abort(401);
        }
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.users.index');
    }

    /**
     * Delete all selected User at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('users_managefull')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = User::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }

}
