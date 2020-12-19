<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Keyword extends Model
{
    protected $fillable = [
        "keyword","gifprovider_id"
    ];

    public function gifproviders()
    {
        return $this->belongsToMany('App\Gifprovider');
    }
}
