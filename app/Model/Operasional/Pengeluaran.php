<?php

namespace App\Model\Operasional;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pengeluaran extends Model
{
    use SoftDeletes;
    protected $table        = "tb_pengeluaran";
    protected $primaryKey   = "pengeluaran_id";
    protected $date         = [
        "created_at",
        "updated_at",
        "deleted_at",
    ];

    public function user(){
        return $this->belongsTo('App\User','user_id','id')->withDefault(function() {
            return new User();
        });
    }
}
