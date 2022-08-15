<?php

namespace App\Model\Akuntansi;

use Illuminate\Database\Eloquent\Model;

class Posting extends Model
{
    protected $table = "akuntansi_posting";
    protected $primarykey = "id";
    protected $date = [
        "created_at",
        "updated_at",
        "deleted_at"
    ];

    public function transaksi(){
        return $this->hasMany('App\Model\Akuntansi\Transaksi');
    }

    public function kdakun(){
        return $this->belongsTo('App\Model\Akuntansi\KodeAkun','kode_akun','id');
    }
}
