<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fabric extends Model
{
    
    public static $fabric;

    public static function saveFabric($request){
        self::$fabric= new fabric();
        self::saveBasicInfo(self::$fabric, $request);
    }

    public static function updateFabric($request, $id){
        self::$fabric= fabric::find($id);

        self::saveBasicInfo(self::$fabric, $request);
    }


    private static function saveBasicInfo($fabric, $request){
        $fabric->name= $request->name;
        $fabric->save();
    }
}
