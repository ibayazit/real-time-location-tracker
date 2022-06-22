<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    protected $fillable = ['name'];

    public function location(){
        return $this->hasOne(Location::class)->orderBy('created_at', 'DESC');
    }

    public function locations(){
        return $this->hasMany(Location::class);
    }
}
