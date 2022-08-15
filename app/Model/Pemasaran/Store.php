<?php

namespace App\Model\Pemasaran;

use App\Model\Master\Kota;
use App\Model\Master\Provinsi;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Store extends Model
{
    use SoftDeletes;
    protected $table        = "tb_store";
    protected $primaryKey   = "store_id";
    protected $date         = [
        "created_at",
        "updated_at",
        "deleted_at",
    ];

    protected $fillable = [
        'store_nama',
        'store_alamat',
        'store_kode',
        'store_region',
        'store_keterangan',
        'kontrak_id',
        'provinsi_id',
        'kota_id',
    ];

    public function provinsi(){
        return $this->belongsTo('App\Model\Master\Provinsi','provinsi_id','id')->withDefault(function(){
            return new Provinsi();
        });
    }

    public function kota(){
        return $this->belongsTo('App\Model\Master\Kota','kota_id','id')->withDefault(function(){
            return new Kota();
        });
    }

    public function kontrak(){
        return $this->belongsTo('App\Model\Pemasaran\Kontrak','kontrak_id','kontrak_id')->withDefault(function() {
            return new Kontrak();
        });
    }
}
