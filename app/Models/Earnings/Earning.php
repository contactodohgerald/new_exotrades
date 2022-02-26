<?php

namespace App\Models\Earnings;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Earning extends Model
{
    use HasFactory, SoftDeletes;
    protected $primaryKey = 'unique_id';
    public $incrementing = false;
    protected $keyType = 'string';

    public function users(){
        return $this->belongsTo('App\Models\User', 'user_unique_id');
    }

    public function transactions(){
        return $this->belongsTo('App\Models\Transaction\Transaction', 'transaction_id');
    } 

    public function getAllEarning($condition, $id = 'id', $desc = "asc"){
        return Earning::where($condition)->orderBy($id, $desc)->get();
    }

    public function getAllEarningPagination($num, $condition, $id = 'id', $desc = "asc"){
        return Earning::where($condition)->orderBy($id, $desc)->paginate($num);
    }

    public function getSingleEarning($condition){
        return Earning::where($condition)->first();
    }

    public function getLastestEarning($condition){
        return Earning::where($condition)->latest()->first();
    }

    public function getSpecificEarning($unique_id){
        return Earning::find($unique_id);
    }

    function countAllEarning($condition){
        $row = Earning::where($condition)->get();
        $cont = 0;$amt = 0;
        foreach($row as $key => $each_row){
            $amt  += $each_row->amount;
        }
        return $amt;       
    }
}
