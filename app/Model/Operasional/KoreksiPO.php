<?php

namespace App\Model\Operasional;

use App\Model\Pemasaran\Kontrak;
use App\Model\Pemasaran\Koreksi;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KoreksiPO extends Model
{
    use SoftDeletes;
    protected $table        = "tb_koreksi_po";
    protected $primaryKey   = "koreksi_po_id";
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

    public function PO(){
        return $this->belongsTo('App\Model\Pemasaran\PO','po_id','po_id')->withDefault(function() {
            return new PO();
        });
    }

    public function koreksi(){
        return $this->belongsTo('App\Model\Pemasaran\Koreksi','koreksi_id','koreksi_id')->withDefault(function() {
            return new Koreksi();
        });
    }

    public function kmain(){
        return $this->belongsTo('App\Model\Pemasaran\Koreksi','koreksi_id','koreksi_id')->withDefault(function() {
            return new Koreksi();
        });
    }
}
