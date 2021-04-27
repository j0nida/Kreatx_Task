<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;


class Department extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function users()
    {
        return $this->hasMany('App\Models\User')->where('deleted',0);
    }

    //cildren
    public function children()
    {
        return $this->hasMany("App\Models\Department", "parent_id");
    }

    public function childrenRecursive()
{
   return $this->children()->with('childrenRecursive');
}

    // parent
    public function parent()
    {
        return $this->belongsTo("App\Models\Department", "parent_id");
    }
    

}
