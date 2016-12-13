<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $fillable = [
        'name',
        'icon',
        'slug',
        'url',
        'parent_id',
        'heightlight_url',
        'sort'
    ];
}
