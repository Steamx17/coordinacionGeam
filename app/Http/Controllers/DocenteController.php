<?php

namespace App\Http\Controllers;

use App\Models\docente;
use App\Models\subject;
use Illuminate\Http\Request;

class DocenteController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:docente.index')->only('index');
        $this->middleware('can:docente.create')->only('create', 'store');
        $this->middleware('can:docente.edit')->only('edit', 'update');
        $this->middleware('can:docente.destroy')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $docentesx = docente::all();

        //dd($grupos);

        return view('profesores.index', compact('docentesx'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $asignatura1 = [0 => 'Seleccione una asignatura'];
        $asignatura2 = subject::pluck('name_subjects', 'id')->toArray();
        $asignat = array_merge($asignatura1, $asignatura2);
        //dd($depart);
        return view('profesores.create', compact('asignat'));
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
            'names_teacher' => 'required',
            'surnames_teacher' => 'required',
            'fullname_teacher' => 'required',
            'subjects_id' => 'required',
            'status' => 'required',
            'observations_teacher' => 'required'
        ]);

        //return $request->all();

        docente::create($request->all());
        return redirect()->route('docente.index')->with('info2', 'docente agregado con exito');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\docente  $docente
     * @return \Illuminate\Http\Response
     */
    public function show(docente $docente)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\docente  $docente
     * @return \Illuminate\Http\Response
     */
    public function edit(docente $docente)
    {
        $asignatura1 = [0 => 'Seleccione una asignatura'];
        $asignatura2 = subject::pluck('name_subjects', 'id')->toArray();
        $asignat = array_merge($asignatura1, $asignatura2);
        //dd($depart);

        return view('profesores.edit', compact('docente', 'asignat'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\docente  $docente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, docente $docente)
    {
        $request->validate([
            'names_teacher' => 'required',
            'surnames_teacher' => 'required',
            'fullname_teacher' => 'required',
            'subjects_id' => 'required',
            'status' => 'required',
            'observations_teacher' => 'required'
        ]);

        $docente->update($request->all());
        // le pasamos el objero grupo 
        return redirect()->route('docente.index')->with('info', 'docente actualizado con exito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\docente  $docente
     * @return \Illuminate\Http\Response
     */
    public function destroy(docente $docente)
    {
        $docente->delete();
    }
}
