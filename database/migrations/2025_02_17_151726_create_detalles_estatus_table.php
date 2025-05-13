<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetallesEstatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalles_estatus', function (Blueprint $table) {
            $table->id();
            $table->decimal('total_respuesta', $precision = 12, $scale = 2)->default(0.00);

            $table->foreignId('id_estatus')->constrained('estatus_critico', 'id');
            $table->foreignId('id_usuario')->constrained('usuarios', 'id');

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
        Schema::dropIfExists('detalles_estatus');
    }
}
