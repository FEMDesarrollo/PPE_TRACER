<?php

namespace App\Imports;

use App\Models\DetallesEquipo;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Carbon\Carbon;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class DetalleEquiposImport implements ToModel, WithHeadingRow, WithValidation
{
    public function model(array $row)
    {
        return new DetallesEquipo([
            'modelo'              => $row['modelo'],
            'no_serie'            => $row['no_serie'],
            'talla'               => $row['talla'],
            'piezas'              => $row['piezas'],
            'fecha_fabricacion'   => $this->parseFechaFlexible($row['fecha_fabricacion'])->format('Y-m-d'),
            'id_usuario_equipo'   => $row['id_usuario_equipo'],
        ]);
    }

    public function rules(): array
    {
        return detallesEquipo::validationRules();
    }

    public function customValidationMessages()
    {
        return detallesEquipo::validationMessages();
    }

    private function parseFechaFlexible($valor)
    {
        if (is_numeric($valor)) {
            return Date::excelToDateTimeObject($valor);
        }

        $formatos = ['d/m/Y', 'Y-m-d', 'm/d/Y', 'd-m-Y', 'Y/m/d', 'd/m/y', 'd-m-y'];

        foreach ($formatos as $formato) {
            try {
                return Carbon::createFromFormat($formato, $valor);
            } catch (\Exception $e) {
                continue;
            }
        }

        // Si no pudo parsear, lanza una excepción clara
        throw new \Carbon\Exceptions\InvalidFormatException("No se pudo parsear la fecha: $valor");
    }
}
