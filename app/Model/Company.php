<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    //指定表名
    protected $table = 'Company';
    protected $primaryKey = 'id';
    public $timestamps = false;
    // 黑名单
    protected $guarded = [];
}
