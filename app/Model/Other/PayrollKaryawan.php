<?php

namespace App\Model\Other;

use Illuminate\Database\Eloquent\Model;

class PayrollKaryawan extends Model
{
    protected $table = "payroll_karyawan";
    protected $primarykey = "karyawan_id";
    protected $date = [
        "created_at",
        "updated_at",
        "deleted_at"
    ];
    protected $fillable = [
            'periode_id'                  ,
            'karyawan_nama'               ,
            'karyawan_jabatan'            ,
            'karyawan_departemen'         ,
            'karyawan_nik'                ,
            'karyawan_gapok'              ,
            'karyawan_tunjangan_jabatan' ,
            'karyawan_uang_makan'         ,
            'karyawan_transport'          ,
            'karyawan_insentif'          ,
            'karyawan_bonus'             ,
            'karyawan_total'              ,
            'karyawan_pinjaman'          ,
            'karyawan_pph'               ,
            'karyawan_lain'              ,
            'karyawan_take_home_pay'
    ];
    public function periode()
    {
        return $this->belongsTo('App\Model\Other\PayrollPeriode', 'periode_id', 'periode_id');
    }
}
