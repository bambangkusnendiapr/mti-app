<?php

namespace App\Model\Operasional;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SuratJalan extends Model
{
    use SoftDeletes;
    protected $table        = "tb_surat_jalan";
    protected $primaryKey   = "surat_jalan_id";
    protected $date         = [
        "created_at",
        "updated_at",
        "deleted_at",
    ];

    public function budget(){
        return $this->belongsTo('App\Model\Operasional\Budget','budget_id','budget_id')->withDefault(function(){
            return new Budget();
        });
    }

    public function bgsj(){
        return $this->belongsTo('App\Model\Operasional\Budget','budget_id','budget_id')->withDefault(function(){
            return new Budget;
        });
    }

    public function kontrak(){
        return $this->belongsTo('App\Model\Pemasaran\Kontrak','kontrak_id','kontrak_id');
    }

    public function barang(){
        return $this->hasMany('App\Model\Operasional\SJBarang','surat_jalan_id','surat_jalan_id');
    }

    public function reconcile(){
        return $this->hasOne('App\Model\Keuangan\Reconcile','surat_jalan_id','surat_jalan_id');
    }
    
}
