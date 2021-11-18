<?php

namespace App\Http\Controllers;

use App\Models\subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:subject.index')->only('index');
        $this->middleware('can:subject.create')->only('create', 'store');
        $this->middleware('can:subject.edit')->only('edit', 'update');
        $this->middleware('can:subject.destroy')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $subject = subject::all();


        return view('subjects.index', compact('subject'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('subjects.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'name_subjects' => 'required|unique:subjects',
            'observations_subjects' => 'required',

        ]);

        //return $request->all();

        subject::create($request->all());
        return redirect()->route('subject.index')->with('info2', 'subject agregado con exito');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function show(subject $subject)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function edit(subject $subject)
    {
        return view('subjects.edit', compact('subject'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, subject $subject)
    {
        $request->validate([
            'name_subjects' => "required|unique:subjects,name_subjects,$subject->id",
            'observations_subjects' => 'required',
        ]);

        $subject->update($request->all());
        return redirect()->route('subject.index')->with('info', 'actualizado con exito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function destroy(subject $subject)
    {
        //
    }
}
