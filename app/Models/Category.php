<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'parent_id',
        'name',
        'url_image',
    ];
    public function setNameAttribute($value){
        $this->attributes['name'] = mb_strtoupper($value);
    }

    public function parent(){
        return $this->belongsTo(Category::class)->with('parent');
    }

    //Scopes
    public function scopeFilterBy($query,$filter){
        $query->where('name','like','%' . $filter . '%');
    }
}
