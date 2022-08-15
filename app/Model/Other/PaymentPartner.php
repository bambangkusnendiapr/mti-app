<?php

namespace App\Model\Other;

use Illuminate\Database\Eloquent\Model;

class PaymentPartner extends Model
{
    protected $table        = "tb_payment_partner";
    protected $primaryKey   = "payment_partner_id";
    protected $date         = [
        "created_at",
        "updated_at",
    ];

    public function purchasing(){
        return $this->belongsTo('App\Model\Other\Purchasing','purchasing_id','purchasing_id')->withDefault(function(){
            return new Purchasing();
        });
    }
}
