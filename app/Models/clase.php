<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class clase extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'start','end', 'description','color', 'textColor','docentes_id', 'grupos_id'];

    //relacion uno a muchos 

    
    public function prueba($id)
    {
        $CantidadEs = DB::table('estudiantes')
            ->select(DB::raw('count(*) as total'))
            ->where('grupos_id', '=', $id)
            ->groupBy('grupos_id')
            ->get();

        foreach ($CantidadEs as $value) {
            return  $value->total;
        }
    }

    public function ObtenerAsignatura($id)
    {
        $Asignatura = DB::table('docentes')
            ->join('subjects', 'subjects.id', '=', 'subjects_id')
            ->select('subjects.name_subjects')
            ->where('docentes.id', '=', $id)->get();


        //dd($Asignatura);

        foreach ($Asignatura as $value) {
            return  $value->name_subjects;
        }
    }



    public function ObtenerDocente($id)
    {
        $docente = DB::table('docentes')
            ->where('id', '=', $id)->get();
        //dd($docente);
        foreach ($docente as  $value) {
            return $value->names_teacher;
        }
    }

    
    public function asistencias()
    {

        return $this->hasMany(asistencia::class, 'id_clases');
    }



}
