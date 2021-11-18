<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clases', function (Blueprint $table) {
            $table->id();
            $table->text('title');
            $table->dateTime('start');
            $table->dateTime('end');
            $table->text('description');
            $table->string('color');
            $table->string('textColor');
            //$table->string('teacher_lessons');
            //$table->string('namegroup_lessons');
            $table->unsignedBigInteger('grupos_id');
            $table->foreign('grupos_id')->references('id')->on('grupos')->onDelete('cascade');
            $table->timestamps();
            $table->tinyInteger('estado')->unsigned()->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clases');
    }
}
