<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Client extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'name',
        'phone',
        'email'
    ];
    
    public function getAuthPassword()
    {
        return $this->password;
    }

    //Scopes
    public function scopeFilterBy($query,$filter){
        $query->where('name','like','%' . $filter . '%')->orWhere('email','like','%' . $filter . '%');
    }
}
