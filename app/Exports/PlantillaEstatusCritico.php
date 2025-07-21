<?php


namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithHeadings;

class PlantillaEstatusCritico implements WithHeadings
{
    public function headings(): array
    {
        return [
        'estatus'
        ];
    }
}

