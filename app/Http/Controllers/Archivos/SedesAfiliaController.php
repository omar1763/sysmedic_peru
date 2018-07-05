<?php

namespace App\Http\Controllers\Archivos;

use App\SedesAfilia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Archivos\StoreSedesAfiliaRequest;
use App\Http\Requests\Archivos\UpdateSedesAfiliaRequest;

class SedesAfiliaController extends Controller
{
    /**
     * Display a listing of User.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('users_manage')) {
            return abort(401);
        }

        $sedesafilia = SedesAfilia::with('roles')->get();

        return view('archivos.sedesafilia.index', compact('sedesafilia'));
    }

    /**
     * Show the form for creating new User.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('users_manage')) {
            return abort(401);
        }

        return view('archivos.sedesafilia.create');
    }

    /**
     * Store a newly created User in storage.
     *
     * @param  \App\Http\Requests\StoreUsersRequest  $request
     * @return \Illuminate\Http\Response
     */
    
    public function store(StoreSedesAfiliaRequest $request)
    {
        if (! Gate::allows('users_manage')) {
            return abort(401);
        }
        $sedesafilia = SedesAfilia::create($request->all());

        return redirect()->route('admin.sedesafilia.index');
    }


    /**
     * Show the form for editing User.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('users_manage')) {
            return abort(401);
        }

        $sedesafilia = SedesAfilia::findOrFail($id);

        return view('archivos.sedesafilia.edit', compact('sedesafilia'));
    }

    /**
     * Update User in storage.
     *
     * @param  \App\Http\Requests\UpdateUsersRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSedesAfiliaRequest $request, $id)
    {
        if (! Gate::allows('users_manage')) {
            return abort(401);
        }
        $sedesafilia = SedesAfilia::findOrFail($id);
        $sedesafilia->update($request->all());
       
        return redirect()->route('admin.sedesafilia.index');
    }

    /**
     * Remove User from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('users_manage')) {
            return abort(401);
        }
        $sedesafilia = SedesAfilia::findOrFail($id);
        $sedesafilia->delete();

        return redirect()->route('admin.sedesafilia.index');
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
            $entries = SedesAfilia::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }

}
