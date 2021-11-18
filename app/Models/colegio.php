<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class colegio extends Model
{
    use HasFactory;
    protected $fillable = ['name_colegios', 'municipios_id'];


    //relacion uno a muchos 

    public function asistencias()
    {

        return $this->hasMany(asistencia::class);
    }

    //relacion uno a muchos inversa

    public function municipios()
    {


        return $this->belongsTo(municipio::class);
    }


    //relacion uno a muchos inversa 


    public function departamentos()
    {

        return $this->hasMany(departamento::class);
    }
}
