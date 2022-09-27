<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Occasion extends Model
{
    public static $occasion;

    public static function saveOccasion($request){
        self::$occasion= new Occasion();
        self::saveBasicInfo(self::$occasion, $request);
    }

    public static function updateOccasion($request, $id){
        self::$occasion= Occasion::find($id);

        self::saveBasicInfo(self::$occasion, $request);
    }


    private static function saveBasicInfo($occasion, $request){
        $occasion->name= $request->name;
        $occasion->save();
    }
}
