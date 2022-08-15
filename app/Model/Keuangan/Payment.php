<?php

namespace App\Model\Keuangan;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
    use SoftDeletes;
    use SoftDeletes;
    protected $table        = "tb_payment";
    protected $primaryKey   = "payment_id";
    protected $date         = [
        "created_at",
        "updated_at",
        "deleted_at",
    ];

    public function invoice(){
        return $this->belongsTo('App\Model\Keuangan\Invoice','invoice_id','invoice_id')->withDefault(function() {
            return new Invoice;
        });
    }
}
