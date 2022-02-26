<?php

namespace App\Models\Coins;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CoinsToPurchase extends Model
{
    use HasFactory, SoftDeletes;
    protected $primaryKey = 'unique_id';
    public $incrementing = false;
    protected $keyType = 'string';

    public function getAllCoinsToPurchase($condition, $id = 'id', $desc = "asc"){
        return CoinsToPurchase::where($condition)->orderBy($id, $desc)->get();
    }

    public function getAllCoinsToPurchasePagination($num, $condition, $id = 'id', $desc = "asc"){
        return CoinsToPurchase::where($condition)->orderBy($id, $desc)->paginate($num);
    }

    public function getSingleCoinsToPurchase($condition){
        return CoinsToPurchase::where($condition)->first();
    }
}
