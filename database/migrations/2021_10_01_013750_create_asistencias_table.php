<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAsistenciasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asistencias', function (Blueprint $table) {

            /*
            $table->id();
            $table->string('date_assistance');
            $table->string('start_time_assistance');
            $table->string('end_time_assistance');
            $table->string('time_elapsed_assistance');
            $table->unsignedBigInteger('id_colegios');
            $table->foreign('id_colegios')->references('id')->on('colegios')->onDelete('cascade');
            $table->unsignedBigInteger('id_clases');
            $table->foreign('id_clases')->references('id')->on('clases')->onDelete('cascade');
            $table->unsignedBigInteger('id_subjects');
            $table->foreign('id_subjects')->references('id')->on('subjects')->onDelete('cascade');
            $table->string('socialized_material_assistance');
            $table->string('main_theme_assistance');
            $table->integer('number_assistants');
            $table->longText('observations_assistance');
            $table->string('evidence_assistance');
            $table->string('modified_by_assistance');
            $table->string('last_modification_assistance'); */
            $table->id();
            $table->unsignedBigInteger('id_estudiantes');
            $table->foreign('id_estudiantes')->references('id')->on('estudiantes')->onDelete('cascade');
            $table->unsignedBigInteger('id_clases');
            $table->foreign('id_clases')->references('id')->on('clases')->onDelete('cascade');
            $table->tinyInteger('present')->unsigned()->default(0);
           // $table->integer('student_id')->unsigned();
            $table->timestamps();

            /*
            $table->increments('id');
            $table->integer('student_id')->unsigned();
            $table->integer('section_id')->unsigned();
            $table->integer('exam_id')->unsigned();
            $table->tinyInteger('present')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->timestamps();
*/
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('asistencias');
    }
}
