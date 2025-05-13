<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetallesEquiposTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalles_equipos', function (Blueprint $table) {
            $table->id();
            $table->string('modelo',255);
            $table->string('no_serie',255)->unique();
            $table->string('talla',255);
            $table->integer('piezas');
            $table->date('fecha_fabricacion');

            $table->foreignId('id_usuario_equipo')->constrained('usuarios_equipos', 'id');

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
        Schema::dropIfExists('detalles_equipos');
    }
}
