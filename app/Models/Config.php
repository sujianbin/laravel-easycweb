<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Config extends Model
{
    protected $table = 'config';
    /**
     * 可以被批量赋值的属性。
     *
     * @var array
     */
    protected $fillable = ['name','value','type'];
    /**
     * 指示模型是否自动维护时间戳
     *
     * @var bool
     */
    public $timestamps = false;
}
