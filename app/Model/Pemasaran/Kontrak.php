<?php

namespace App\Model\Pemasaran;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kontrak extends Model
{
    use SoftDeletes;
    protected $table        = "tb_kontrak";
    protected $primaryKey   = "kontrak_id";
    protected $date         = [
        "created_at",
        "updated_at",
        "deleted_at",
    ];

    public function krani(){
        return $this->belongsTo('App\User','user_id','id');
    }

    public function pic(){
        return $this->hasMany('App\Model\Pemasaran\PIC','kontrak_id','kontrak_id')->withDefault(function() {
            return new PIC();
        });
    }

    public function store(){
        return $this->hasMany('App\Model\Pemasaran\Store','kontrak_id','kontrak_id')->withDefault(function() {
            return new Store();
        });
    }

    public function invoice(){
        return $this->hasMany('App\Model\Keuangan\Invoice','kontrak_id','kontrak_id');
    }

    public function sj(){
        return $this->hasMany('App\Model\Operasional\SuratJalan','kontrak_id','kontrak_id');
    }

}
