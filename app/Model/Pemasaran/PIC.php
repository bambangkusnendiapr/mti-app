<?php

namespace App\Model\Pemasaran;

use App\Model\Master\Jabatan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PIC extends Model
{
    use SoftDeletes;
    protected $table        = "tb_pic";
    protected $primaryKey   = "pic_id";
    protected $date         = [
        "created_at",
        "updated_at",
        "deleted_at",
    ];

    public function kontrak(){
        return $this->belongsTo('App\Model\Pemasaran\Kontrak','kontrak_id','kontrak_id');
    }

    public function jabatan(){
        return $this->belongsTo('App\Model\Master\Jabatan','jabatan_id','jabatan_id')->withDefault(function() {
            return new Jabatan();
        });
    }

}
