<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Statuses;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;

class StatusesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $statuses = Statuses::all();
        // dd($roles);
        return view('Statuses.index',['request'=> $statuses]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Statuses.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'detail' => 'required',
            'status' => 'required',
        ]);
        $statuses = Statuses::create($validateData);
        return redirect('/statuses')->with('success','Data Status berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $statuses = Statuses::findOrFail($id);
        return view('statuses.edit', ['request'=> $statuses]);//
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validateData = $request->validate([
            'detail' => 'required',
            'status' => 'required',
        ]);
        $statuses = Statuses::find($id);
        $statuses->update($validateData);
        return redirect('/statuses')->with('success','Data Status berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
