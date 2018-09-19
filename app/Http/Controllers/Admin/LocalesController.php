<?php

namespace App\Http\Controllers\Admin;

use App\Empresas;
use App\Locales;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreEmpresasRequest;
use App\Http\Requests\Admin\UpdateEmpresasRequest;

class LocalesController extends Controller
{
    /**
     * Display a listing of User.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        


          $locales = DB::table('locales as a')
        ->select('a.id','a.nombres','a.id_empresa','b.nombre as empresa')
        ->join('empresas as b','b.id','a.id_empresa')
        ->paginate(5000);

        return view('admin.locales.index', compact('locales'));
    }

    /**
     * Show the form for creating new User.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $empresas = Empresas::get()->pluck('nombre', 'id');

        return view('admin.locales.create',compact('empresas'));
    }

    /**
     * Store a newly created User in storage.
     *
     * @param  \App\Http\Requests\StoreUsersRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        


       $locales = new Locales;
       $locales->nombres =$request->nombres;
       $locales->id_empresa =$request->empresas;
       $locales->save();


        return redirect()->route('admin.locales.index');
    }


    /**
     * Show the form for editing User.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        

        $locales = Locales::findOrFail($id);
        $empresas = Empresas::get()->pluck('nombre', 'id');

        
        return view('admin.locales.edit', compact('locales','empresas'));
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
        
        $locales = Locales::findOrFail($id);
        $locales->update($request->all());
       
        return redirect()->route('admin.locales.index');
    }

    /**
     * Remove User from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       
        $locales = Locales::findOrFail($id);
        $locales->delete();

        return redirect()->route('admin.locales.index');
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
            $entries = Locales::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }

}
