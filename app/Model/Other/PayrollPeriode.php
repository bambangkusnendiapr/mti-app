<?php

namespace App\Model\Other;

use Illuminate\Database\Eloquent\Model;

class PayrollPeriode extends Model
{
    protected $table = "payroll_periode";
    protected $primarykey = "periode_id";
    protected $date = [
        "created_at",
        "updated_at",
        "deleted_at"
    ];

    public function karyawan()
    {
        return $this->hasMany('App\Model\Other\PayrollKaryawan', 'periode_id', 'periode_id');
    }

}
