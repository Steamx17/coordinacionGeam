<?php

namespace App\Http\Controllers;

use App\Models\municipio;
use Illuminate\Http\Request;

class MunicipioController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');

        // $this->middleware('can:subject.index')->only('index');
        // $this->middleware('can:subject.create')->only('create');
        // $this->middleware('can:subject.edit')->only('edit');
        // $this->middleware('can:subject.destroy')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\municipio  $municipio
     * @return \Illuminate\Http\Response
     */
    public function show(municipio $municipio)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\municipio  $municipio
     * @return \Illuminate\Http\Response
     */
    public function edit(municipio $municipio)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\municipio  $municipio
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, municipio $municipio)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\municipio  $municipio
     * @return \Illuminate\Http\Response
     */
    public function destroy(municipio $municipio)
    {
        //
    }
}
