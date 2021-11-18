<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class grupo extends Model
{
    use HasFactory;
    // hablilitamos la asignacion masiva de la siguiente manera

    protected $fillable = ['cod_group', 'name_group', 'grade_group', 'observation_group', 'municipios_id'];
    //-------------------------------------------------------------------------
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




    public function estudiantes()
    {

        return $this->hasMany(estudiante::class);
    }



    
    //relacion uno a muchos inversa 
    public function municipios()
    {

        return $this->hasMany(municipio::class);
    }

    public function departamentos()
    {

        return $this->hasMany(departamento::class);
    }


    public function generarCodigo($longitud = 1)
    {
        $key = '';
        $pattern = 'G1234567890abcdefghijklmnopqrstuvwxyz';
        $max = strlen($pattern) - 1;

        for ($x = 0; $x < $longitud; $x++)
            $key .= $pattern[mt_rand(0, $max)];

        //$key .= $pattern{mt_rand(0, $max)};

        return $key;
    }
}
