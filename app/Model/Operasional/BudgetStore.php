<?php

namespace App\Model\Operasional;

use App\Model\Pemasaran\Store;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BudgetStore extends Model
{
    use SoftDeletes;
    protected $table        = "tb_budgetstore";
    protected $primaryKey   = "budgetstore_id";
    protected $date         = [
        "created_at",
        "updated_at",
        "deleted_at",
    ];

    public function budget(){
        return $this->belongsTo('App\Model\Operasional\Budget','budget_id','budget_id')->withDefault(function() {
            return new Budget();
        });
    }

    public function store(){
        return $this->belongsTo('App\Model\Pemasaran\Store','store_id','store_id')->withDefault(function() {
            return new Store();
        });
    }
}
