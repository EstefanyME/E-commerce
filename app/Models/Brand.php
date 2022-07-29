<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'url_logo'
    ];

    public function products(){
        return $this->hasMany(Product::class);
    }

    public function setNameAttribute($value){
        $this->attributes['name'] = mb_strtoupper($value);
    }

    //Scopes
    public function scopeFilterBy($query,$filter){
        $query->where('name','like','%' . $filter . '%');
    }
}
