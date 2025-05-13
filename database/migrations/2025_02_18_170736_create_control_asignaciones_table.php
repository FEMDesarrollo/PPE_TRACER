<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateControlAsignacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('control_asignaciones', function (Blueprint $table) {
            $table->id();
            $table->longText('observaciones');
            $table->date('fecha_asignacion');
            $table->date('fecha_devolucion');

            $table->foreignId('id_usuario_equipo')->constrained('usuarios_equipos', 'id');
            $table->foreignId('id_estatus_critico')->constrained('estatus_critico', 'id');

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
        Schema::dropIfExists('control_asignaciones');
    }
}
