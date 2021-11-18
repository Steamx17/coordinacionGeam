<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class estudiante extends Model
{
    use HasFactory;

    protected $fillable = ['identification_students', 'names_students', 'grupos_id'];


    public function cargaIdAsistencia($idEstu, $idClase)
    {
        $Aasistencia = DB::table('asistencias')
            ->select('id')
            ->where('id_estudiantes', '=', $idEstu)
            ->where('id_clases', '=', $idClase)
            ->get();


        foreach ($Aasistencia as $value) {
            return  $value->id;
        }
    }

    public function cargaStatusAsistencia($idEstu, $idClase)
    {
        $Aasistencia = DB::table('asistencias')
            ->select('present')
            ->where('id_estudiantes', '=', $idEstu)
            ->where('id_clases', '=', $idClase)
            ->get();


        foreach ($Aasistencia as $value) {
            return  $value->present;
        }
    }



    // //relacion uno a muchos inversa 

    public function grupos()
    {


        return $this->belongsTo(grupo::class);
    }

    public function asistencias()
    {

        return $this->hasMany(asistencia::class);
    }
}
