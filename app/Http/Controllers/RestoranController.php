<?php

namespace App\Http\Controllers;

use App\Models\Restoran;
use Illuminate\Auth\Access\Gate;
use Illuminate\Http\Request;

class RestoranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('restorans.index', ['restorans'=>Restoran::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('restorans.edit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        Restoran::create($request->all());
        return redirect()->route('restoran.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Restoran  $restoran
     * @return \Illuminate\Http\Response
     */
    public function show(Restoran $restoran)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Restoran  $restoran
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Restoran $restoran)
    {
        if (Gate::denies('edit')){
            return redirect()->route('restoran.index');
        }
        return view('restorans.edit',['restoran'=>$restoran]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Restoran  $restoran
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Restoran $restoran)
    {
        $restoran->fill($request->all());
        $restoran->save();
        return redirect()->route('restoran.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Restoran  $restoran
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Restoran $restoran)
    {
        $restoran->delete();
        return redirect()->route('restoran.index');
    }
}
