<?php

namespace App\Model\Master;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Jabatan extends Model
{
    use SoftDeletes;
    protected $table        = "master_jabatan";
    protected $primaryKey   = "jabatan_id";
    protected $date         = [
        "created_at",
        "updated_at",
        "deleted_at",
    ];
}
