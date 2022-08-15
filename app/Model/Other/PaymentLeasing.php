<?php

namespace App\Model\Other;

use Illuminate\Database\Eloquent\Model;

class PaymentLeasing extends Model
{
    protected $table        = "tb_leasing_payment";
    protected $primaryKey   = "leasing_payment_id";
    protected $date         = [
        "created_at",
        "updated_at",
    ];

    public function leasing(){
        return $this->belongsTo('App\Model\Other\Leasing','leasing_id','leasing_id')->withDefault(function(){
            return new Leasing();
        });
    }
}
