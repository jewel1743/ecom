<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Upazila extends Model
{
    use HasFactory;

    public function unions(){
        return $this->hasMany(Union::class,'upazilla_id'); //akhane forgen key ta dite holo tar karon hosse database er union table er vitor upazila table er forgen key ta upazila_id na hoye upazilla_id ase tai key ta ullekh korte holo,, jodi upazila_id thkto tahole auto hoye jeto onno der moto
    }

    public function district(){
        return $this->belongsTo(District::class);
    }
}
