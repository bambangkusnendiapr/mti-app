<?php

namespace App\Model\Keuangan;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InvoiceDetail extends Model
{
    use SoftDeletes;
    protected $table        = "tb_invoice_detail";
    protected $primaryKey   = "invoice_detail_id";
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

    public function reconcile(){
        return $this->belongsTo('App\Model\Keuangan\Reconcile','reconcile_id','reconcile_id')->withDefault(function() {
            return new Reconcile;
        });
    }
}
