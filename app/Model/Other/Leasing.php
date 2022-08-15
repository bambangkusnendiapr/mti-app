<?php

namespace App\Model\Other;

use App\Model\Master\Kendaraan;
use Illuminate\Database\Eloquent\Model;

class Leasing extends Model
{
    protected $table        = "tb_leasing";
    protected $primaryKey   = "leasing_id";
    protected $date         = [
        "created_at",
        "updated_at",
    ];

    public function kendaraan(){
        return $this->belongsTo('App\Model\Master\Kendaraan','kendaraan_id','kendaraan_id')->withDefault(function(){
            return new Kendaraan();
        });
    }

    public function payment(){
        return $this->hasMany('App\Model\Other\PaymentLeasing','leasing_id','leasing_id');
    }
}
