<?php

namespace App\Imports;

use App\Models\EstatusCritico;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class EstatusCriticoImport implements ToModel, WithHeadingRow
{
     public function model(array $row)
    {
        return new EstatusCritico([
            'estatus'        => $row['estatus'],
        ]);
    }
    
}
