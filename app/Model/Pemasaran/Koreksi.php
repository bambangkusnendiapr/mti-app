<?php

namespace App\Model\Pemasaran;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Koreksi extends Model
{
    use SoftDeletes;
    protected $table        = "tb_koreksi";
    protected $primaryKey   = "koreksi_id";
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

    // public function jabatan(){
    //     return $this->belongsTo('App\Model\Master\Jabatan','jabatan_id','jabatan_id')->withDefault(function() {
    //         return new Jabatan();
    //     });
    // }
}
