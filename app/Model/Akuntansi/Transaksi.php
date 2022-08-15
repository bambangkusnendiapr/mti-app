<?php

namespace App\Model\Akuntansi;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $table = "akuntansi_transaksi";
    protected $primarykey = "id";
    protected $date = [
        "created_at",
        "updated_at",
        "deleted_at"
    ];

   public function kodeakun()
   {
       return $this->hasOne('App\Model\Akuntansi\KodeAkun','kode_akun', 'id');
   }

   public function akun()
   {
        return $this->belongsTo('App\Model\Akuntansi\KodeAkun','kode_akun','id')->withDefault(function(){
            return new KodeAkun();
        });
   }

    public function posting()
    {
        return $this->belongsTo('App\Model\Akuntansi\Posting','posting_id','id')->withDefault(function(){
            return new Posting;
        });
    }

}

