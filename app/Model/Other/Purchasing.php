<?php

namespace App\Model\Other;

use App\Model\Master\Kendaraan;
use App\Model\Master\Partner;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Purchasing extends Model
{
    use SoftDeletes;
    protected $table        = "tb_purchasing";
    protected $primaryKey   = "purchasing_id";
    protected $date         = [
        "created_at",
        "updated_at",
    ];

    public function partner(){
        return $this->belongsTo('App\Model\Master\Partner','partner_id','partner_id')->withDefault(function(){
            return new Partner();
        });
    }

    public function kendaraan(){
        return $this->belongsTo('App\Model\Master\Kendaraan','kendaraan_id','kendaraan_id')->withDefault(function(){
            return new Kendaraan();
        });
    }

    public function payment(){
        return $this->hasMany('App\Model\Other\PaymentPartner','purchasing_id','purchasing_id');
    }
}
