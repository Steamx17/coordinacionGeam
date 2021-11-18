<?php

namespace App\Http\Controllers;

use App\Models\clase;
use App\Models\docente;
use App\Models\grupo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClaseController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:clase.index')->only('index');
        $this->middleware('can:clase.create')->only('create', 'store');
        $this->middleware('can:clase.edit')->only('edit', 'update');
        //$this->middleware('can:clase.destroy')->only('destroy','update');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {

        $rol = Auth::user()->getRoleNames();

        if ($rol[0] == "Docente") {
            if ($request->ajax()) {

                $events = clase::where('docentes_id', Auth::user()->id)->get();

                return response()->json($events);
            }

            return view('clases.index');

        } else {

            $docente1 = [0 => 'Seleccione un docente'];
            $docente2 = docente::pluck('names_teacher', 'id')->toArray();
            $docente = array_merge($docente1, $docente2);
            $grupo1 = [0 => 'Seleccione un grupo'];
            $grupo2 = grupo::pluck('name_group', 'id')->toArray();
            $grupo = array_merge($grupo1, $grupo2);
            //dd($docente);
            if ($request->ajax()) {
                $events = clase::whereDate('start', '>=', $request->start)
                ->whereDate('end', '<=', $request->end)
                ->where('estado', '=', 1)
                ->get(['id', 'title', 'start', 'end', 'description', 'color', 'textColor', 'docentes_id', 'grupos_id']);
                return response()->json($events);
            }
            return view('clases.index', compact('docente', 'grupo'));
        }
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

        $clase = clase::create($request->all());
        dd($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\clase  $clase
     * @return \Illuminate\Http\Response
     */
    public function show(clase $clase)
    {

        $clase = clase::all()->where('estado', '=', 1);
        return response()->json($clase);
        //return json_encode($clase);



    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\clase  $clase
     * @return \Illuminate\Http\Response
     */
    public function edit(clase $clase)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\clase  $clase
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        $clase = clase::find($request->id)->update([
            'title' => $request->title,
            'start' => $request->start,
            'end' => $request->end,
            'description' => $request->description,
            'color' => $request->color,
            'textColor' => $request->textColor,
            'teacher_lessons' => $request->teacher_lessons,
            'grupos_id' => $request->grupos_id,
        ]);

        // $clase->update($request->all());
        return response()->json($clase);
    }



    public function updatexx(Request $request)
    {

        /* $clase = clase::find($request->id)->update([
            'title' => $request->title,
            'start' => $request->start,
            'end' => $request->end,
            'description' => $request->description,
            'color' => $request->color,
            'textColor' => $request->textColor,
            'teacher_lessons' => $request->teacher_lessons,
            'grupos_id' => $request->grupos_id,
        ]);*/

        $clase = clase::find($request->id)->update($request->all());


        // $clase->update($request->all());
        return response()->json($clase);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\clase  $clase
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
     //   $clase = clase::find($request->id)->update($request->estado);
        //dd($clase);

        $clase = clase::where('id',$request->id)->update(array('estado' => '0'));
        return response()->json($clase); 
    }
}




