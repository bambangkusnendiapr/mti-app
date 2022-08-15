<?php

namespace App\Model\Operasional;

use App\Model\Master\Driver;
use App\Model\Master\JenisKendaraan;
use App\Model\Master\Kendaraan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Budget extends Model
{
    use SoftDeletes;
    protected $table        = "tb_budget";
    protected $primaryKey   = "budget_id";
    protected $date         = [
        "created_at",
        "updated_at",
        "deleted_at",
    ];

    public function jenis(){
        return $this->belongsTo('App\Model\Master\JenisKendaraan','jenis_kendaraan_id','jenis_kendaraan_id')->withDefault(function() {
            return new JenisKendaraan();
        });
    }

    public function kendaraan(){
        return $this->belongsTo('App\Model\Master\Kendaraan','kendaraan_id','kendaraan_id')->withDefault(function() {
            return new Kendaraan();
        });
    }

    public function driver(){
        return $this->belongsTo('App\Model\Master\Driver','driver_id','driver_id')->withDefault(function() {
            return new Driver();
        });
    }

    public function po(){
        return $this->belongsTo('App\Model\Operasional\PO','po_id','po_id')->withDefault(function(){
            return new PO();
        });
    }

    public function bstore(){
        return $this->hasMany('App\Model\Operasional\BudgetStore','budget_id','budget_id');
    }

    public function koreksi(){
        return $this->hasMany('App\Model\Operasional\KoreksiPO','budget_id','budget_id');
    }

}
