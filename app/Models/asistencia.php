<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class asistencia extends Model
{
    use HasFactory;
    protected $fillable = ['id_estudiantes', 'id_clases', 'present'];

    //relacion uno a muchos inversa 


    public function estudiantes()
    {

        return $this->belongsTo(estudiante::class);
    }

    public function colegios()
    {


        return $this->belongsTo(colegio::class);
    }


    public function subjects()
    {


        return $this->belongsTo(subject::class);
    }


    public function clasesx()
    {
        return $this->belongsTo(clase::class)->withDefault([
            'title' => 'Anónimo',
        ]);
    }


    // relacion de muchos a muchos 
    /* public function nombre()
    {
        return $this->belongsToMany(clase::class);
    }*/


    function compararFechas($primera, $segunda)
    {

        
        $valoresPrimera = explode("/", $primera);
        $valoresSegunda = explode("/", $segunda);

        $diaPrimera    = $valoresPrimera[0];
        $mesPrimera  = $valoresPrimera[1];
        $anyoPrimera   = $valoresPrimera[2];

        $diaSegunda   = $valoresSegunda[0];
        $mesSegunda = $valoresSegunda[1];
        $anyoSegunda  = $valoresSegunda[2];

        $diasPrimeraJuliano = gregoriantojd($mesPrimera, $diaPrimera, $anyoPrimera);
        $diasSegundaJuliano = gregoriantojd($mesSegunda, $diaSegunda, $anyoSegunda);

        if (!checkdate($mesPrimera, $diaPrimera, $anyoPrimera)) {
            // "La fecha ".$primera." no es v&aacute;lida";
            return 0;
        } elseif (!checkdate($mesSegunda, $diaSegunda, $anyoSegunda)) {
            // "La fecha ".$segunda." no es v&aacute;lida";
            return 0;
        } else {
            return  $diasPrimeraJuliano - $diasSegundaJuliano;
        }
    }



}
