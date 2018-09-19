<?php

namespace App\Http\Controllers\Admin;

use App\Empresas;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreEmpresasRequest;
use App\Http\Requests\Admin\UpdateEmpresasRequest;

class EmpresasController extends Controller
{
    /**
     * Display a listing of User.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        


          $empresas = DB::table('empresas as a')
        ->select('*')
        ->paginate(5000);

        return view('admin.empresas.index', compact('empresas'));
    }

    /**
     * Show the form for creating new User.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        

        return view('admin.empresas.create');
    }

    /**
     * Store a newly created User in storage.
     *
     * @param  \App\Http\Requests\StoreUsersRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        


       $empresas = new Empresas;
       $empresas->nombre =$request->nombre;
       $empresas->save();


        return redirect()->route('admin.empresas.index');
    }


    /**
     * Show the form for editing User.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        

        $empresas = Empresas::findOrFail($id);

        return view('admin.empresas.edit', compact('empresas'));
    }

    /**
     * Update User in storage.
     *
     * @param  \App\Http\Requests\UpdateUsersRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        $empresas = Empresas::findOrFail($id);
        $empresas->update($request->all());
       
        return redirect()->route('admin.empresas.index');
    }

    /**
     * Remove User from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       
        $empresas = Empresas::findOrFail($id);
        $empresas->delete();

        return redirect()->route('admin.empresas.index');
    }

    /**
     * Delete all selected User at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('users_manage')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Empresas::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }

}
