<?php

namespace App\Model\Master;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Karyawan extends Model
{
    use SoftDeletes;
    protected $table        = "master_karyawan";
    protected $primaryKey   = "karyawan_id";
    protected $date         = [
        "created_at",
        "updated_at",
        "deleted_at",
    ];

    public function jabatan(){
        return $this->belongsTo('App\Model\Master\Jabatan','jabatan_id','jabatan_id');
    }
}
