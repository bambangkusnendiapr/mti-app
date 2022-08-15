<?php

namespace App\Model\Operasional;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SJBarang extends Model
{
    use SoftDeletes;
    protected $table        = "tb_sj_barang";
    protected $primaryKey   = "sj_barang_id";
    protected $date         = [
        "created_at",
        "updated_at",
        "deleted_at",
    ];

    public function sj(){
        return $this->belongsTo('App\Model\Operasional\SuratJalan','surat_jalan_id','surat_jalan_id')->withDefault(function() {
            return new SuratJalan();
        });
    }
}
