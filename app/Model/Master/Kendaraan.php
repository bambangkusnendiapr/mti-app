<?php

namespace App\Model\Master;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kendaraan extends Model
{
    use SoftDeletes;
    protected $table        = "master_kendaraan";
    protected $primaryKey   = "kendaraan_id";
    protected $date         = [
        "created_at",
        "updated_at",
        "deleted_at",
    ];

    public function jenis(){
        return $this->belongsTo('App\Model\Master\JenisKendaraan','jenis_kendaraan_id','jenis_kendaraan_id')->withDefault(function() {
            return new JenisKendaraan();
        });
    }

    public function partner(){
        return $this->belongsTo('App\Model\Master\Partner','partner_id','partner_id')->withDefault(function(){
            return new Partner();
        });
    }

    public function purchasing(){
        return $this->hasMany('App\Model\Other\Purchasing','kendaraan_id','kendaraan_id');
    }

    public function leasing(){
        return $this->hasMany('App\Model\Other\Leasing','kendaraan_id','kendaraan_id');
    }
    
}
