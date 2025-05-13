<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubestacionesEquiposTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subestaciones_equipos', function (Blueprint $table) {
            $table->id();
            $table->integer('no_traje')->nullable();

            $table->foreignId('id_equipo')->constrained('equipos', 'id');
            $table->foreignId('id_estacion')->constrained('estaciones', 'id');
            $table->foreignId('id_subestacion')->constrained('subestaciones', 'id');
            
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subestaciones_equipos');
    }
}
