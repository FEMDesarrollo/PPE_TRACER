<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubestacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subestaciones', function (Blueprint $table) {
            $table->id();
            $table->string('nombre',255);
            $table->longText('direccion');
            $table->string('telefono');

            $table->foreignId('id_estacion')->constrained('estaciones', 'id');

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
        Schema::dropIfExists('subestaciones');
    }
}
