<?php

namespace App\Imports;

use App\Model\Other\PayrollKaryawan;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;

class PayrollImport implements ToModel, WithHeadingRow, WithCalculatedFormulas
{
    /**
    * @param Collection $collection
    */
    public function model(array $row)
    {
        return new PayrollKaryawan([
            'periode_id'                  => $row['periode'],
            'karyawan_nama'               => $row['nama'],
            'karyawan_jabatan'            => $row['jabatan'],
            'karyawan_departemen'         => $row['departemen'],
            'karyawan_nik'                => $row['nik'],
            'karyawan_gapok'              => $row['gapok'],
            'karyawan_tunjangan_jabatan'  => $row['tunjangan_jabatan'],
            'karyawan_uang_makan'         => $row['uang_makan'],
            'karyawan_transport'          => $row['transport'],
            'karyawan_insentif'           => $row['insentif'],
            'karyawan_bonus'              => $row['bonus'],
            'karyawan_total'              => $row['total'],
            'karyawan_pinjaman'           => $row['pinjaman'],
            'karyawan_pph'                => $row['pph'],
            'karyawan_lain'               => $row['lain'],
            'karyawan_take_home_pay'      => $row['take_home_pay']
        ]);
    }
}
