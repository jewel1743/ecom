<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Union extends Model
{
    use HasFactory;

    public function upazila(){
        return $this->belongsTo(Upazila::class,'upazilla_id');
    }
}
