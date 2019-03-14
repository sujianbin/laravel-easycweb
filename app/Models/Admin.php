<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $table = 'admin';

    public function role()
    {
        return $this->belongsTo('App\Models\AdminRole','role_id','id');
    }
}
