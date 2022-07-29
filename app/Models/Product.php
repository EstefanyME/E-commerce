<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'brand_id',
        'category_id',
        'barcode',
        'name',
        'description',
        'price',
        'stock',
        'url_image'
    ];

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    //Scopes
    public function scopeFilterBy($query,$filter){
        $query->where('name','like','%' . $filter . '%')->orWhere('barcode','like','%' . $filter . '%');
    }
}
