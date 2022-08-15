<?php

namespace App\Model\Keuangan;

use App\Model\Master\Karyawan;
use App\Model\Pemasaran\Kontrak;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invoice extends Model
{
    use SoftDeletes;
    protected $table        = "tb_invoice";
    protected $primaryKey   = "invoice_id";
    protected $date         = [
        "created_at",
        "updated_at",
        "deleted_at",
    ];

    public function kontrak(){
        return $this->belongsTo('App\Model\Pemasaran\Kontrak','kontrak_id','kontrak_id')->withDefault(function() {
            return new Kontrak();
        });
    }

    public function detail(){
        return $this->hasMany('App\Model\Keuangan\InvoiceDetail','invoice_id','invoice_id');
    }

    public function karyawan(){
        return $this->belongsTo('App\Model\Master\Karyawan','karyawan_id','karyawan_id')->withDefault(function(){
            return new Karyawan();
        });
    }

    public function payment(){
        return $this->hasMany('App\Model\Keuangan\Payment','invoice_id','invoice_id');
    }
}
