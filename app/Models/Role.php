<?php
namespace  App\Models;

use Zizaco\Entrust\EntrustRole;

class Role extends EntrustRole
{
    protected $fillable = ['name', 'display_name', 'description'];

    public function permission()
    {
        return $this->belongsToMany('App\Models\Permission','permission_role','role_id','permission_id');
    }
}