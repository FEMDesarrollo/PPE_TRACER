<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsuariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id();
            $table->string('nombre',255);
            $table->string('app',255);
            $table->string('apm',255);
            $table->string('telefono');
            $table->string('correo')->unique();
            $table->longText('password')->nullable();
            $table->longText('foto')->nullable();

            $table->foreignId('id_estacion')->constrained('estaciones', 'id');
            $table->foreignId('id_subestacion')->constrained('subestaciones', 'id');
            $table->foreignId('id_perfil')->constrained('perfiles', 'id');

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
        Schema::dropIfExists('usuarios');
    }
}
