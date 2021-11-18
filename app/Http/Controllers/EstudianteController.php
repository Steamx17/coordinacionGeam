<?php

namespace App\Http\Controllers;

use App\Models\estudiante;
use App\Models\grupo;
use Illuminate\Http\Request;

class EstudianteController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:estudiante.index')->only('index');
        $this->middleware('can:estudiante.create')->only('create','store');
        $this->middleware('can:estudiante.edit')->only('edit','update');
        $this->middleware('can:estudiante.destroy')->only('destroy');
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //  $estudiantes = estudiante::all(); // Metodo para traer todos los elementos de la tabla 
        $estudiantes = estudiante::all();

        //dd($estudiantes);
        return view('estudiantes.index', compact('estudiantes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $grupo1 = [0 => 'Seleccione un grupo'];
        $grupo2 = grupo::pluck('name_group', 'id')->toArray();
        $grupo = array_merge($grupo1, $grupo2);

        //dd($grupo);
        return view('estudiantes.create', compact('grupo'));
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
            'identification_students' => 'required|unique:estudiantes',
            'names_students' => 'required',
            'grupos_id' => 'required'
        ]);

        estudiante::create($request->all());
        return redirect()->route('estudiante.index')->with('info2', 'Estudiante agregado con exito');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\estudiante  $estudiante
     * @return \Illuminate\Http\Response
     */
    public function show(estudiante $estudiante)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\estudiante  $estudiante
     * @return \Illuminate\Http\Response
     */
    public function edit(estudiante $estudiante)
    {

        $grupo1 = [0 => 'Seleccione un grupo'];
        $grupo2 = grupo::pluck('name_group', 'id')->toArray();
        $grupo = array_merge($grupo1, $grupo2);

        //dd($grupo);


        return view('estudiantes.edit', compact('grupo', 'estudiante'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\estudiante  $estudiante
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, estudiante $estudiante)
    {

        // creamos una validacion de todos los datos que mandamos del formulario
        $request->validate([
            'identification_students' => "required|unique:estudiantes,identification_students,$estudiante->id",
            'names_students' => 'required',
            'grupos_id' => 'required'
        ]);

        $estudiante->update($request->all());
        // le pasamos el obj estudiante 
        return redirect()->route('estudiante.index')->with('info', 'Estudiante actualizado con exito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\estudiante  $estudiante
     * @return \Illuminate\Http\Response
     */
    public function destroy(estudiante $estudiante)
    {
        //
    }
}
