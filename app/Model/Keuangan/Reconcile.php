<?php

namespace App\Model\Keuangan;

use App\Model\Operasional\SuratJalan;
use App\Model\Pemasaran\Kontrak;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reconcile extends Model
{
    use SoftDeletes;
    protected $table        = "tb_reconcile";
    protected $primaryKey   = "reconcile_id";
    protected $date         = [
        "created_at",
        "updated_at",
        "deleted_at",
    ];

    public function kontrak(){
        return $this->belongsTo('App\Model\Operasional\Kontrak','kontrak_id','kontrak_id')->withDefault(function() {
            return new Kontrak();
        });
    }

    public function sj(){
        return $this->belongsTo('App\Model\Operasional\SuratJalan','surat_jalan_id','surat_jalan_id')->withDefault(function() {
            return new SuratJalan();
        });
    }
}
