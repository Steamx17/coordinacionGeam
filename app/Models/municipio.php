<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class municipio extends Model
{
    use HasFactory;




    //relacion uno a muchos 

    public function grupos()
    {

        return $this->hasMany(grupo::class);
    }


    public function colegios()
    {

        return $this->hasMany(colegio::class);
    }


    //relacion uno a muchos inversa

    public function departamentos()
    {


        return $this->belongsTo(departamento::class);
    }

   

}
