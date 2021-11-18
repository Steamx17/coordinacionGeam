<?php

namespace App\Http\Controllers;

use App\Models\colegio;
use App\Models\departamento;
use App\Models\grupo;
use Illuminate\Http\Request;

class ColegioController extends Controller
{
  /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:colegio.index')->only('index');
        $this->middleware('can:colegio.create')->only('create','store');
        $this->middleware('can:colegio.edit')->only('edit','update');
        $this->middleware('can:colegio.destroy')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $colegio = colegio::join('municipios', 'municipios.id', '=', 'municipios_id')
            ->join('departamentos', 'departamentos.id', '=', 'departamentos_id')
            ->select(
                'colegios.id',
                'colegios.name_colegios',
                'municipios_id',
                'municipios.name_municipios',
                'departamentos.name_department'
            )->get();

        // dd($institucions);

        return view('instituciones.index', compact('colegio'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $depart1 = [0 => 'Seleccione un departamento'];
        $depart2 = departamento::pluck('name_department', 'id')->toArray();
        $depart = array_merge($depart1, $depart2);
        //dd($depart);
        return view('instituciones.create', compact('depart'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name_colegios' => 'required',
            'municipios_id' => 'required',
            'departamentoadd' => 'required'
        ]);

        //return $request->all();

        colegio::create($request->all());
        return redirect()->route('colegio.index')->with('info2', 'Colegio agregado con exito');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\colegio  $colegio
     * @return \Illuminate\Http\Response
     */
    public function show(colegio $colegio)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\colegio  $colegio
     * @return \Illuminate\Http\Response
     */
    public function edit(colegio $colegio)
    {
        $depart1 = [0 => 'Seleccione un departamento'];
        $depart2 = departamento::pluck('name_department', 'id')->toArray();
        $depart = array_merge($depart1, $depart2);


        $colegioEdit = colegio::join('municipios', 'municipios.id', '=', 'municipios_id')
            ->join('departamentos', 'departamentos.id', '=', 'departamentos_id')
            ->select(
                'departamentos.id',
                'departamentos.name_department'
            )->where("colegios.id", "=", $colegio->id)->get();




        //  dd($colegioEdit);
        return view('instituciones.edit', compact('depart', 'colegio', 'colegioEdit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\colegio  $colegio
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, colegio $colegio)
    {
        
        $request->validate([
            'name_colegios' => 'required',
            'municipios_id' => 'required',
            'departamentoadd' => 'required'
        ]);

        $colegio->update($request->all());
        // le pasamos el objero grupo 
        return redirect()->route('colegio.index')->with('info', 'actualizado con exito');



    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\colegio  $colegio
     * @return \Illuminate\Http\Response
     */
    public function destroy(colegio $colegio)
    {
        //
    }
}
