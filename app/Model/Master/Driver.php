<?php

namespace App\Model\Master;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Driver extends Model
{
    use SoftDeletes;
    protected $table        = "master_driver";
    protected $primaryKey   = "driver_id";
    protected $date         = [
        "created_at",
        "updated_at",
        "deleted_at",
    ];

    // public function kategori(){
    //     return $this->hasOne('App\Model\Apotek\Master\Kategori','kategori_id','kategori_id');
    // }
}
