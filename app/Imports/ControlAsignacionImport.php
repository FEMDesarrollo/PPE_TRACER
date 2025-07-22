<?php

namespace App\Imports;

use App\Models\controlAsignaciones;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Carbon\Carbon;
use PhpOffice\PhpSpreadsheet\Shared\Date;



class ControlAsignacionImport implements ToModel, WithHeadingRow, WithValidation
{

    public function model(array $row)
    {
        return new controlAsignaciones([
            'observaciones'        => $row['observaciones'],
            'fecha_asignacion'     => $this->parseFechaFlexible($row['fecha_asignacion'])->format('Y-m-d'),
            'fecha_devolucion'      => $this->parseFechaFlexible($row['fecha_devolucion'])->format('Y-m-d'),
            'id_usuario_equipo'  => $row['id_usuario_equipo'],
            'id_estatus_critico'  => $row['id_estatus_critico'],


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
        return controlAsignaciones::validationRules();
    }

    public function customValidationMessages()
    {
        return controlAsignaciones::validationMessages();
    }
}

