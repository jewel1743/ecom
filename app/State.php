<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    use HasFactory;
    protected $guard=[
        'name',
        'country_id',
        'country_code',
        'fips_code',
        'iso2',
        'type',
        'latitude',
        'longitude',
        'created_at',
        'updated_at',
        'flag',
        'status',
        'wikiDataId',
    ];

    public function cities(){
        return $this->hasMany(City::class);
    }

    public function country(){
        return $this->belongsTo(Country::class);
    }
}
