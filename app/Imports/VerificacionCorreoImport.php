<?php

namespace App\Imports;

use App\Models\VerificacionCorreo;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Carbon\Carbon;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class VerificacionCorreoImport implements ToModel, WithHeadingRow, WithValidation
{
    public function model(array $row)
    {
        return new VerificacionCorreo([
            'codigo_verificacion' => $row['codigo_verificacion'],
            'fecha'               => $this->parseFechaFlexible($row['fecha'])->format('Y-m-d'),
            'id_usuario'          => $row['id_usuario'],
        ]);
    }

    private function parseFechaFlexible($valor)
    {
        // Si es numérico, probablemente es un serial de Excel
        if (is_numeric($valor)) {
            return Date::excelToDateTimeObject($valor);
        }

        // múltiples formatos de fecha
        $formatos = ['d/m/Y', 'Y-m-d', 'm/d/Y', 'd-m-Y', 'Y/m/d', 'd/m/y', 'd-m-y'];

        foreach ($formatos as $formato) {
            try {
                return Carbon::createFromFormat($formato, $valor);
            } catch (\Exception $e) {
                continue;
            }
        }

        // Si falla todo, lanza excepción para detectar el error
        throw new \Carbon\Exceptions\InvalidFormatException("No se pudo entender la fecha: $valor");
    }

    public function rules(): array
    {
        return VerificacionCorreo::validationRules();
    }

    public function customValidationMessages()
    {
        return VerificacionCorreo::validationMessages();
    }
}
