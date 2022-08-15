<?php

namespace App\Imports;

use App\Model\Pemasaran\Tarif;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class TarifImport implements ToModel, WithHeadingRow, WithCalculatedFormulas
{
    public function model(array $row)
    {
        return new Tarif([
            'tarif_klien'               => $row['tarif'],
            'tarif_mti_uang_jalan'      => $row['uang_jalan'],
            'jenis_kendaraan_id'        => $row['jenis'],
            'store_id'                  => $row['store_id'],
        ]);
    }
}
