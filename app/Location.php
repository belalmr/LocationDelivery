<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $primaryKey = 'id';

    protected $fillable=[
        'lat', 'lng', 'id', 'title'
    ];
}
