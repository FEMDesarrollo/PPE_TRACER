<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
    Schema::create('notificaciones', function (Blueprint $table) {
        $table->id();
        $table->string('icono')->default('bi bi-info-circle text-primary');
        $table->string('titulo');
        $table->string('mensaje');
        $table->foreignId('user_id')->constrained('usuarios')->onDelete('cascade');
        $table->timestamps();
    });
}
}
