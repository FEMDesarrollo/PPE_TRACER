<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsuariosEquiposTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuarios_equipos', function (Blueprint $table) {
            $table->id();
            $table->date('fecha_estatus');
            $table->longText('comentarios');

            $table->foreignId('id_estatus_equipo')->constrained('estatus_equipos', 'id');
            $table->foreignId('id_usuario')->constrained('usuarios', 'id');
            $table->foreignId('id_equipo')->constrained('equipos', 'id');

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
        Schema::dropIfExists('usuarios_equipos');
    }
}
