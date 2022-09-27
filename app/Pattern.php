<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pattern extends Model
{
    public static $pattern;

    public static function savePattern($request){
        self::$pattern= new Pattern();
        self::saveBasicInfo(self::$pattern, $request);
    }

    public static function updatePattern($request, $id){
        self::$pattern= Pattern::find($id);

        self::saveBasicInfo(self::$pattern, $request);
    }


    private static function saveBasicInfo($pattern, $request){
        $pattern->name= $request->name;
        $pattern->save();
    }
}
