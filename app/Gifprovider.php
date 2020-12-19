<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gifprovider extends Model
{
    protected $fillable = [
        'slug',"description","calls","credentials"
    ];

    public function keywords()
    {
        return $this->belongsToMany('App\Keyword');
    }
}
