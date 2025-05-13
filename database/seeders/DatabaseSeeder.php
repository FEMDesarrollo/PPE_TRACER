<?php

namespace Database\Seeders;

use App\Models\EstatusEquipo;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        $this->call([
            Perfiles::class,
            Estaciones::class,
            Subestaciones::class,
            Usuarios::class,
            Permisos::class,
            PermisosUsuarios::class,
            GestionInspecciones::class,
            EstatusCriticos::class,
            EstatusEquipos::class,
            Equipos::class,
            Accesorios::class,
            UsuarioEquipos::class,
        ]);
        Schema::enableForeignKeyConstraints();
    }
}
