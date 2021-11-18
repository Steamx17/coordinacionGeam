<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class subject extends Model
{
    use HasFactory;

    protected $fillable = ['name_subjects', 'observations_subjects'];
    //relacion uno a muchos 

    public function asistencias()
    {

        return $this->hasMany(asistencia::class);
    }



    public function docentes()
    {

        return $this->hasMany(docente::class);
    }
    
}
