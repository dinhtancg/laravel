<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    const PAGINATE_LIMIT = 5;
    protected $fillable = ['name', 'slug', 'permission'];

    public function users()
    {
        return $this->belongsToMany('App\User', 'users_roles');
    }

    public function permissions() {
        return $this->belongsToMany(Permission::class,'roles_permissions');
    }


}
