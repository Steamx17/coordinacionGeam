<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class docente extends Model
{
    use HasFactory;

    protected $fillable = ['names_teacher', 'surnames_teacher', 'fullname_teacher', 'subjects_id', 'status', 'observations_teacher'];



    // //relacion uno a muchos inversa 

    public function subjects()
    {


        return $this->belongsTo(subject::class);
    }
}
