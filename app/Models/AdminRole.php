<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminRole extends Model
{
    protected $table = 'admin_role';

    public function admin()
    {
        return $this->hasMany('App\Model\Admin','id','role_id');
    }
}
