<?php

namespace App\Models\Settings;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SiteSetting extends Model
{
    use HasFactory, SoftDeletes;
    protected $primaryKey = 'unique_id';
    public $incrementing = false;
    protected $keyType = 'string';

    public function getSettings($unique_id = 'OGU9ZhIK0e66e8b70e91fea8'){
        $condition = [
            ['unique_id', $unique_id]
        ];
        return SiteSetting::where($condition)->first();
    }

    public function selectSpecificColumn($columnName){
        return SiteSetting::select($columnName)->first();
    }
}
