<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['sort_id', 'parent_id', 'name', 'slug','active','icon','text','text1'];

    public function parent()
    {
        return $this->hasOne('App\Category', 'id','parent_id');
    }

    public function children()
    {
        return $this->hasMany('App\Category', 'parent_id')->with('children');
    }

    public function products()
    {
        return $this->hasMany('App\Product', 'category_id');
    }
    public function photo()
    {
        return $this->morphOne('App\Photo', 'pictures');
    }
}
