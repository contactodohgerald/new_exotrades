<?php

namespace App\Models\Plans;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InvestmentPlan extends Model
{
    use HasFactory, SoftDeletes;
    protected $primaryKey = 'unique_id';
    public $incrementing = false;
    protected $keyType = 'string';

    public function getAllPlans($condition, $id = 'id', $desc = "asc"){
        return InvestmentPlan::where($condition)->orderBy($id, $desc)->get();
    }

    public function getSinglePlan($condition){
        return InvestmentPlan::where($condition)->first();
    }
}
