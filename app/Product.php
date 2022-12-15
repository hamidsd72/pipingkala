<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;

class Product extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function modell()
    {
        return $this->hasMany('App\Models','product_id','id');
    }

    public function category()
    {
        return $this->belongsTo('App\Category', 'category_id');
    }

    public function brand()
    {
        return $this->belongsTo('App\Brand', 'brand_id');
    }

    public function provider()
    {
        return $this->belongsTo('App\Provider', 'provider_id');
    }

    public function attribute()
    {
        return $this->hasOne('App\Attribute','id','attribute_id');
    }

    public function photo()
    {
        return $this->morphMany('App\Photo', 'pictures');
    }

    public function attribjoin()
    {
        return $this->hasmany('App\AttributeProductJoin','product_id','id');
    }

    public function comparjoin()
    {
        return $this->hasmany('App\ComparisonProductJoin','product_id','id');
    }

    public function visits()
    {
        return $this->hasMany('App\ProductVisit', 'product_id','id');
    }

    public function prices()
    {
        return $this->hasmany('App\Price','product_id','id');
    }
    public function prate()
    {
        return $this->hasmany('App\Prate','product_id','id');
    }
    protected static function boot()
    {
        parent::boot();
        static::deleting(function ($item) {
            $item->photo()->get()
                ->each(function ($photo) {
                    $path = $photo->path;
                    File::delete($path);
                    $photo->delete();
                });
            File::delete($item->pic);
            File::delete($item->flag);
        });
    }

    public function scopeSearch($query, $term)
    {
        $columns = "title,description,phisical_text";
        $query->whereRaw("MATCH ({$columns}) AGAINST ('".$term."')");

        return $query;
    }

}
