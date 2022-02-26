<?php

namespace App\Models\WalletAddress;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WalletAddress extends Model
{
    use HasFactory, SoftDeletes;
    protected $primaryKey = 'unique_id';
    public $incrementing = false;
    protected $keyType = 'string';

    public function getAllWalletAddress($condition, $id = 'id', $desc = "asc"){
        return WalletAddress::where($condition)->orderBy($id, $desc)->get();
    }

    public function getAllWalletAddressPagination($num, $condition, $id = 'id', $desc = "asc"){
        return WalletAddress::where($condition)->orderBy($id, $desc)->paginate($num);
    }

    public function getSingleWalletAddress($condition){
        return WalletAddress::where($condition)->first();
    }

    public function getSpecificWalletAddress($unique_id){
        return WalletAddress::find($unique_id);
    }
}
