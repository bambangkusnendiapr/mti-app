<?php

namespace App\Model\Akuntansi;

use Illuminate\Database\Eloquent\Model;

class KodeAkun extends Model
{
    protected $table = "akuntansi_kode_akun";
    protected $primarykey = "id";
    protected $date = [
        "created_at",
        "updated_at",
        "deleted_at"
    ];
    public function transaksi()
    {
        return $this->hasMany('App\Model\Akuntansi\Transaksi', 'kode_akun', 'id');
    }


}
