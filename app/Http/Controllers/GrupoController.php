<?php

namespace App\Http\Controllers;

use App\Models\departamento;
use App\Models\estudiante;
use App\Models\grupo;
use App\Models\municipio;
use Barryvdh\DomPDF\PDF as DomPDFPDF;
use PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use JeroenNoten\LaravelAdminLte\Components\Form\Select;

class GrupoController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:grupo.index')->only('index');
        $this->middleware('can:grupo.create')->only('create', 'store');
        $this->middleware('can:grupo.edit')->only('edit', 'update');
        $this->middleware('can:grupo.destroy')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index()
    {
        //$grupos = grupo::all(); // Metodo para traer todos los elementos de la tabla 
        $grupos = grupo::join('municipios', 'municipios.id', '=', 'municipios_id')
            ->join('departamentos', 'departamentos.id', '=', 'departamentos_id')
            ->select(
                'grupos.id',
                'grupos.cod_group',
                'grupos.name_group',
                'grupos.id',
                'grupos.grade_group',
                'grupos.observation_group',
                'municipios.name_municipios',
                'departamentos.name_department'
            )->get();

        return view('grupos.index', compact('grupos'));

        //return $grupos;
    }

    /**
     * Show the form for creating a new resource. 
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $obj =  new grupo();

        $codigo =  "G-" . date('is') . $obj->generarCodigo(6);
        $depart1 = [0 => 'Seleccione un departamento'];
        $depart2 = departamento::pluck('name_department', 'id')->toArray();
        $depart = array_merge($depart1, $depart2);
        //dd($depart);
        return view('grupos.create', compact('depart', 'codigo'));
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
            'cod_group' => 'required|unique:grupos',
            'name_group' => 'required',
            'grade_group' => 'required',
            'observation_group' => 'required',
            'municipios_id' => 'required',
            'departamentoadd' => 'required'
        ]);

        //return $request->all();

        grupo::create($request->all());
        return redirect()->route('grupo.index')->with('info2', 'Grupo agregado con exito');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\grupo  $grupo
     * @return \Illuminate\Http\Response
     */
    public function show(grupo $grupo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\grupo  $grupo
     * @return \Illuminate\Http\Response
     */
    public function edit(grupo $grupo)
    {
        $depart1 = [0 => 'Seleccione un departamento'];
        $depart2 = departamento::pluck('name_department', 'id')->toArray();
        $depart = array_merge($depart1, $depart2);
        $grupoEdit = grupo::join('municipios', 'municipios.id', '=', 'municipios_id')
            ->join('departamentos', 'departamentos.id', '=', 'departamentos_id')
            ->select(
                'departamentos.id',
                'departamentos.name_department'
            )->where("grupos.id", "=", $grupo->id)
            ->get();

        //dd($grupoEdit);
        return view('grupos.edit', compact('depart', 'grupo', 'grupoEdit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\grupo  $grupo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, grupo $grupo)
    {
        $request->validate([
            'cod_group' => "required|unique:grupos,cod_group,$grupo->id",
            'name_group' => 'required',
            'grade_group' => 'required',
            'observation_group' => 'required',
            'municipios_id' => 'required',
            'departamentoadd' => 'required'
        ]);

        $grupo->update($request->all());
        // le pasamos el objero grupo 
        return redirect()->route('grupo.index')->with('info', 'Grupo actualizado con exito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\grupo  $grupo
     * @return \Illuminate\Http\Response
     */
    public function destroy(grupo $grupo)
    {
        //
    }


    public function byMunicipios($id)
    {
        return  municipio::where('departamentos_id', $id)->get();
    }


    public function GetCantidadGrupos()
    {
        // Contar cuantos rejistros existen en la tabla grrupos 
        return grupo::all()->groupBy('id')->count();
    }

    /*  public function contarAllGrupo($id=1)
    {
        $CantidadEs  = DB::table('estudiantes')
            ->select(DB::raw('count(*) as total'))
            ->where('grupos_id', '=', $id)
            ->groupBy('grupos_id')
            ->get();


        
    }*/

    public function viewCantEstuGrupo($id)
    {
        $detalle = null;


        $detalle =  estudiante::join("grupos", "grupos.id", "=", "estudiantes.grupos_id")
            ->select("estudiantes.identification_students", "estudiantes.names_students", "grupos.cod_group", "grupos.name_group")
            ->where("grupos.id", "=", $id)
            ->get();

        $nombreGrupo = grupo::all()->where('id', $id);



        //dd($nombreGrupo);

        return view('grupos.liststud', compact('detalle', 'nombreGrupo'));
    }

    public function generarPdf($id)
    {

        $detalle = null;


        $detalle =  estudiante::join("grupos", "grupos.id", "=", "estudiantes.grupos_id")
            ->select("estudiantes.identification_students", "estudiantes.names_students", "grupos.cod_group", "grupos.name_group")
            ->where("grupos.id", "=", $id)
            ->get();

        $nombreGrupo = grupo::all()->where('id', $id);

     

        $pdf = PDF::loadView('reporte.ListaEstudiantes',compact('detalle', 'nombreGrupo'));
    	return $pdf->setPaper('A3', 'landscape')->stream('Lista_de_Estudiantes.pdf');
        //dd($nombreGrupo);

       // return view('reporte.ListaEstudiantes', compact('detalle', 'nombreGrupo'));
    }
}
