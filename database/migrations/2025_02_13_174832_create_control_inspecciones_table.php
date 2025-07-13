<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateControlInspeccionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('control_inspecciones', function (Blueprint $table) {
            $table->id();
            $table->enum('respuestas',['si','no'])->default('no');
            $table->date('fecha');
            $table->longText('imagen')->nullable();
            $table->longText('descripcion');

            $table->foreignId('id_usuario')->constrained('usuarios', 'id');
            $table->foreignId('id_gestion_inspeccion')->constrained('gestion_inspecciones', 'id');

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
        Schema::dropIfExists('control_inspecciones');
    }
}
