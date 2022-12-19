<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ComparisonProductJoin extends Model
{

    public function compare()
    {
        return $this->hasOne('App\Comparison','id','comparison_id');
    }

    public function product()
    {
        return $this->hasOne('App\Product','id','product_id');
    }

    public $timestamps = false;

}