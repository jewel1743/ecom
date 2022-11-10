<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    protected $guard=[
        'name',
        'state_id',
        'state_code',
        'country_id',
        'country_code',
        'latitude',
        'longitude',
        'created_at',
        'updated_at',
        'flag',
        'wikiDataId',
    ];

    public function state(){
        return $this->belongsTo(State::class);
    }

    public function country(){
        return $this->belongsTo(Country::class);
    }
}
