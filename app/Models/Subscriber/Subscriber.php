<?php

namespace App\Models\Subscriber;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subscriber extends Model
{
    use HasFactory, SoftDeletes;
    protected $primaryKey = 'unique_id';
    public $incrementing = false;
    protected $keyType = 'string';

    public function getAllSubscriber($condition, $id = 'id', $desc = "desc"){
        return Subscriber::where($condition)->orderBy($id, $desc)->get();
    }

    public function getSingleSubscriber($condition){
        return Subscriber::where($condition)->first();
    }
}
