<?php

namespace App\Model\Pemasaran;

use App\Model\Master\JenisKendaraan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tarif extends Model
{
    use SoftDeletes;
    protected $table        = "tb_tarif";
    protected $primaryKey   = "tarif_id";
    protected $date         = [
        "created_at",
        "updated_at",
        "deleted_at",
    ];

    protected $fillable = [
        'tarif_klien',
        'tarif_mti_uang_jalan',
        'tarif_keterangan',
        'store_id',
        'jenis_kendaraan_id',
    ];

    public function store(){
        return $this->belongsTo('App\Model\Pemasaran\Store','store_id','store_id')->withDefault(function() {
            return new Store();
        });
    }

    public function jenis(){
        return $this->belongsTo('App\Model\Master\JenisKendaraan','jenis_kendaraan_id','jenis_kendaraan_id')->withDefault(function(){
            return new JenisKendaraan();
        });
    }
}
