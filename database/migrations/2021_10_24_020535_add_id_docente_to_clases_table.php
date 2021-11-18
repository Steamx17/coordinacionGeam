<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIdDocenteToClasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('clases', function (Blueprint $table) {
            $table->unsignedBigInteger('docentes_id');
            $table->foreign('docentes_id')->references('id')->on('docentes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('clases', function (Blueprint $table) {
            //
        });
    }
}
