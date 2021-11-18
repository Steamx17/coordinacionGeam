<?php

namespace App\Http\Controllers;

use App\Models\asistencia;
use App\Models\colegio;
use App\Models\docente;
use App\Models\grupo;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:home')->only('index');

      // acomodar un midelware 
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $asistencias = asistencia::all()->groupBy('id_clases')->count();
        $profesores = docente::all()->groupBy('id')->count();
        $grupos = grupo::all()->groupBy('id')->count();
        $colegios = colegio::all()->groupBy('id')->count();

        return view('home', compact('asistencias', 'profesores', 'grupos', 'colegios'));
    }
}
