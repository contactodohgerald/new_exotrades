<?php

namespace App\Models\WalletAddress;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserWalletAddress extends Model
{
    use HasFactory, SoftDeletes;
    protected $primaryKey = 'unique_id';
    public $incrementing = false;
    protected $keyType = 'string';

    public function system_wallet(){
        return $this->belongsTo('App\Models\WalletAddress\WalletAddress', 'wallet_addresse_id');
    } 

    public function getAllUserWalletAddress($condition, $id = 'id', $desc = "asc"){
        return UserWalletAddress::where($condition)->orderBy($id, $desc)->get();
    }

    public function getSingleUserWalletAddress($condition){
        return UserWalletAddress::where($condition)->first();
    }

    public function getSpecificUserWalletAddress($unique_id){
        return UserWalletAddress::find($unique_id);
    }
}
