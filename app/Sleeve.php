<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sleeve extends Model
{
    public static $sleeve;

    public static function savesleeve($request){
        self::$sleeve= new Sleeve();
        self::saveBasicInfo(self::$sleeve, $request);
    }

    public static function updateSleeve($request, $id){
        self::$sleeve= Sleeve::find($id);

        self::saveBasicInfo(self::$sleeve, $request);
    }


    private static function saveBasicInfo($sleeve, $request){
        $sleeve->name= $request->name;
        $sleeve->save();
    }
}
