<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function users()
    {
        return $this->hasMany("App\Models\User");
    }


    public function children()
    {
        return $this->hasMany("App\Models\Department", "parent_id", "id");
    }
    

    // parent
    public function parent()
    {
        return $this->belongsTo("App\Models\Department", "parent_id", "id");
    }

}
