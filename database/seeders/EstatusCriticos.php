<?php

namespace Database\Seeders;

use App\Models\EstatusCritico;
use Illuminate\Database\Seeder;

class EstatusCriticos extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        EstatusCritico::truncate();

        $fechaActual = now()->toDateTimeString();

        EstatusCritico::insert([
            [
                'id'                    => 1,
                'estatus'               => 'bajo',
                'created_at'            => $fechaActual,
                'updated_at'            => $fechaActual
            ],
            [
                'id'                    => 2,
                'estatus'               => 'medio',
                'created_at'            => $fechaActual,
                'updated_at'            => $fechaActual
            ],
            [
                'id'                    => 3,
                'estatus'               => 'alto',
                'created_at'            => $fechaActual,
                'updated_at'            => $fechaActual
            ],

        ]);
    }
}
