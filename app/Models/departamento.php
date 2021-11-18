<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class departamento extends Model
{
    use HasFactory;



    //relacion uno a muchos 

    public function municipios()
    {

        return $this->hasMany(municipio::class);
    }




    
}
