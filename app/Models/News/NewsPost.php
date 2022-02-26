<?php

namespace App\Models\News;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class NewsPost extends Model
{
    use HasFactory, SoftDeletes;
    protected $primaryKey = 'unique_id';
    public $incrementing = false;
    protected $keyType = 'string';

    public function users(){
        return $this->belongsTo('App\Models\User', 'user_unique_id');
    } 

    public function getAllNewsPost($condition, $id = 'id', $desc = "desc"){
        return NewsPost::where($condition)->orderBy($id, $desc)->get();
    }

    public function getAllNewsPostPagination($num, $condition, $id = 'id', $desc = "asc"){
        return NewsPost::where($condition)->orderBy($id, $desc)->paginate($num);
    }

    public function getSingleNewsPost($condition){
        return NewsPost::where($condition)->first();
    }
    
}
