<?php

namespace App\Model\Operasional;

use App\Model\Pemasaran\Kontrak;
use App\Model\Pemasaran\PIC;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PO extends Model
{
    use SoftDeletes;
    protected $table        = "tb_po";
    protected $primaryKey   = "po_id";
    protected $date         = [
        "created_at",
        "updated_at",
        "deleted_at",
    ];

    public function kontrak(){
        return $this->belongsTo('App\Model\Pemasaran\Kontrak','kontrak_id','kontrak_id')->withDefault(function(){
            return new Kontrak();
        });
    }

    public function pic(){
        return $this->belongsTo('App\Model\Pemasaran\PIC','pic_id','pic_id')->withDefault(function(){
            return new PIC();
        });
    }

    public function budget(){
        return $this->hasMany('App\Model\Operasional\Budget','po_id','po_id');
    }
    
}
