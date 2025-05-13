<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRepuestosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('repuestos', function (Blueprint $table) {
            $table->id();
            $table->decimal('costo', $precision = 12, $scale = 2)->nullable()->default(0.0);
            $table->date('fecha_disponible')->nullable();

            $table->foreignId('id_prov_servicio')->constrained('Proveedor_servicios', 'id');
            $table->foreignId('id_accesorio')->constrained('accesorios', 'id');

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
        Schema::dropIfExists('repuestos');
    }
}
