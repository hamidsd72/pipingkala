<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;

class Models extends Model
{

    public $timestamps = false;
    protected $guarded = ['id'];

//    public function product()
//    {
//        return $this->hasOne('App\Product','id','product_id');
//    }
//
//    public function photo()
//    {
//        return $this->morphOne('App\Photo', 'pictures');
//    }
}