<?php

namespace App\Model\Master;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Partner extends Model
{
    use SoftDeletes;
    protected $table        = "master_partner";
    protected $primaryKey   = "partner_id";
    protected $date         = [
        "created_at",
        "updated_at",
        "deleted_at",
    ];

    public function ap(){
        return $this->hasMany('App\Model\Other\Purchasing','partner_id','partner_id');
    }
}
