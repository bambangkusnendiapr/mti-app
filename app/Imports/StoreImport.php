<?php

namespace App\Imports;

use App\Model\Pemasaran\Store;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class StoreImport implements ToModel, WithHeadingRow, WithCalculatedFormulas
{
    public function model(array $row)
    {
        return new Store([
            'store_kode'        => $row['kode'],
            'store_nama'        => $row['nama'],
            'store_alamat'      => $row['alamat'],
            'provinsi_id'       => $row['provinsi'],
            'kota_id'           => $row['kota'],
            'store_region'      => $row['region'],
            'store_keterangan'  => $row['ket'],
            'kontrak_id'        => $row['id_kontrak'],
        ]);
    }
}
