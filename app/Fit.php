<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fit extends Model
{
    public static $fit;

    public static function saveFit($request){
        self::$fit= new Fit();
        self::saveBasicInfo(self::$fit, $request);
    }

    public static function updateFit($request, $id){
        self::$fit= Fit::find($id);

        self::saveBasicInfo(self::$fit, $request);
    }


    private static function saveBasicInfo($fit, $request){
        $fit->name= $request->name;
        $fit->save();
    }
}
