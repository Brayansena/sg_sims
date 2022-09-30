<?php

namespace App\Imports;

use App\Models\Dispositivo;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithUpserts;

class DispositivoImport implements ToModel, WithHeadingRow, WithUpserts
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Dispositivo([
            'marca'=>$row['marca'],
            'descripcion'=>$row['descripcion'],
            'id'=>$row['activo'],
            'serial'=>$row['serial'],
            'tipoDispositivo'=>$row['tipo_dispositivo'],
            'fechaAsignacion'=>$row['fecha_asignacion'],
            'id_puntoVenta'=>$row['cod_pdv'],
            'nombrePDv'=>$row['nombre_pdv'],
            'cedulaResponsable'=>$row['cc_responsable'],
            'responsable'=>$row['responsable'],
            'numeroActa'=>$row['numero_acta'],
            'estado'=>$row['estado'],
            'mac'=>$row['mac'],
            'imei'=>$row['imei'],
            'capacidad'=>$row['capacidad'],
            'observacion'=>$row['observacion'],
        ]);
    }
    public function uniqueBy()
    {
        return 'id';
    }
}
