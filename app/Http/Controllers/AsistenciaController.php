<?php

namespace App\Http\Controllers;

use App\Models\asistencia;
use App\Models\clase;
use App\Models\colegio;
use App\Models\docente;
use App\Models\estudiante;
use App\Models\Evidencia;
use App\Models\grupo;
use App\Models\subject;
use GuzzleHttp\Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class AsistenciaController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->Middleware('auth');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {

        $clase = clase::join('grupos', 'grupos.id', '=', 'grupos_id')
            ->join('docentes', 'docentes.id', '=', 'docentes_id')
            ->select(
                'clases.id as clase_id',
                'clases.title',
                'clases.start',
                'clases.end',
                'clases.grupos_id',
                'grupos.name_group',
                'clases.docentes_id'
            )->get();
        /*
                $Asignatura = docente::join('municipios', 'municipios.id', '=', 'municipios_id')
                ->join('departamentos', 'departamentos.id', '=', 'departamentos_id')
                ->select(
                    'departamentos.id',
                    'departamentos.name_department'
                )->where("grupos.id", "=", 1)
                ->get();
                */
        // dd($Asignatura);



        return view('asistencia.index', compact('clase'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $campo = json_decode($request->toPost, true);
        //dd($campo);


        foreach ($campo as $key => $value) {
            $estudiante = asistencia::where('id_estudiantes', '=', $value['id_estudiantes'])
                ->where('id_clases', '=', $value['id_clases'])->first();

            if ($estudiante) {
                $fecha_actual = strtotime(date("d-m-Y H:i:00", time()));
                $fecha_entrada = strtotime($value['end']);

                if ($fecha_actual > $fecha_entrada) {
                    $res = 0;
                } else {
                    $estudiante->update($value);
                    //  dd($value);
                    $res = "Se actualizo correctamente";
                }
            } else {

                asistencia::create($value);
                $res = "Se agrego correctamente";
            }


            //dd($value['id_estudiantes'], $value['id_clases']);
            // dd($estudiante);

        }

        return $res;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\asistencia  $asistencia
     * @return \Illuminate\Http\Response
     */
    public function show(asistencia $asistencia)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\asistencia  $asistencia
     * @return \Illuminate\Http\Response
     */
    public function edit(asistencia $asistencia)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\asistencia  $asistencia
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, asistencia $asistencia)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\asistencia  $asistencia
     * @return \Illuminate\Http\Response
     */
    public function destroy(asistencia $asistencia)
    {
        //
    }



    public function TomarAsistencia($grupos_id, $clase_id)
    {

        $estudianteG = null;

        $estudianteG =  estudiante::join("grupos", "grupos.id", "=", "estudiantes.grupos_id")
            ->select("estudiantes.identification_students", "estudiantes.names_students", "grupos.cod_group", "grupos.name_group", "estudiantes.id")
            ->where("grupos.id", "=", $grupos_id)
            ->get();

        //$asistenciaxx = asistencia::all()->where('id_clases', $clase_id);

        $clase = clase::find($clase_id);
        $nombreGrupo = grupo::find($grupos_id);

        //  grupo::all()->where('id', $grupos_id);  


        return view('asistencia.Asistencia', compact('estudianteG', 'nombreGrupo', 'clase'));
        //dd($estudianteG);


    }

    public function Asistencias_Estudiante($estudiante_id)
    {
        //$Asistencia = asistencia::where('id_estudiantes', '=', $estudiante_id)->get();
        $Asistencia = asistencia::join("estudiantes", "estudiantes.id", "=", "id_estudiantes")
            ->join("clases", "clases.id", "=", "id_clases")
            ->select("asistencias.*", "clases.*")
            ->where("estudiantes.id", "=", $estudiante_id)->get();

        $estudianteG =  estudiante::where("id", "=", $estudiante_id)->get();

        // $clase = clase::find($clase_id);


        // dd($Asistencia);
        return view('asistencia.asitencia_estudiante', compact('estudianteG', 'Asistencia'));



        /* return \DB::table('tablaasitecnai')
        ->select('id_estudiante', \DB::raw('
          COUNT(CASE WHEN present=1 THEN present END) AS totalPresent,
          COUNT(CASE WHEN present=0 THEN present END) AS totalAbsent,
        ))
        ->where('id_clase', $id_clase)
        ->where('id_estudiante', $id_estudiante)
        ->groupBy('id_estudiante')
        ->get();*/
    }



    public function subirArchivo(Request $request)
    {

        /* $request->validate([
        'file' => 'required|image|max:2048'
    ]);
*/
        $evidencias = $request->file('file')->store('public/evidencias');

        $url = Storage::url($evidencias);

        //$url = Storage::put('evidencias', $request->file('file'));


        Evidencia::create([
            'grupo_id' => $request->grupo_id,
            'url' => $url,
            'clase_id' => $request->clase_id,
        ]);

        // dd($request->all());
        //$ext = pathinfo($evidencias,PATHINFO_EXTENSION);
        // dd($ext);
    }



    public function MostrarEvidencia($grupo_id, $clase_id)
    {

        $infoevidencia = Evidencia::where("grupo_id", "=", $grupo_id)
            ->where("clase_id", "=", $clase_id)
            ->get();

        $clase = clase::find($clase_id);
        $nombreGrupo = grupo::find($grupo_id);




        //dd($infoevidencia);
        return view('asistencia.verEvidencia', compact('infoevidencia', 'nombreGrupo', 'clase'));
    }

    public function editarEvidencia(Evidencia $Evidencia)
    {
        return $Evidencia;
    }


    public function eliminarEvidencia(Evidencia $Evidencia)
    {

        $url = str_replace('storage', 'public', $Evidencia->url);
        Storage::delete($url);

        $Evidencia->delete($url);


        //return redirect()->route('asistencia.index');
        return redirect()->back();
    }
}
