<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    protected $primaryKey = 'unique_id';
    public $incrementing = false;
    protected $keyType = 'string';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'unique_id',
        'name',
        'email',
        'referral_id',
        'referred_id',
        'account_type',
        'status',
        'country',
        'phone',
        'gender',
        'address',
        'avatar',
        'account_number',
        'main_balance',
        'ref_bonus_balance',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getUsersWithCondition($condition, $id = 'id', $desc = "desc"){
        return User::where($condition)->orderBy($id, $desc)->get();
    }

    public function getUsersWithConditionPaginate($num, $condition, $id = 'id', $desc = "desc"){
        return User::where($condition)->orderBy($id, $desc)->paginate($num);
    }

    public function getSingleUserWithCondition($condition){
        return User::where($condition)->first();
    }

    public function selectSpecificColumn($columnName, $condition){
        return User::select($columnName)->where($condition)->first();
    }

    public function getSpecificUser($unique_id){
        return User::find($unique_id);
    }

}
