<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $guard=['brand_name','brand_image','status'];
    protected static $image,$imageName,$directory,$imageUrl,$brand;

    public static function getImageUrl($request){
        self::$image= $request->file('brand_image');
        if(self::$image){
            self::$imageName= $request->brand_name.'_'.time().'.'.self::$image->getClientOriginalExtension();
            self::$directory= 'images/brand-images/';
            self::$image->move(self::$directory, self::$imageName);
            self::$imageUrl= self::$directory.self::$imageName;
            return self::$imageUrl;
        }else{
            return '';
        }
    }

    public static function saveBrand($request){
        self::$brand= new Brand();
        self::saveBasicInfo(self::$brand, $request, self::getImageUrl($request));
    }

    public static function updateBrand($request, $id){
        self::$brand= Brand::find($id);
        if($request->hasfile('brand_image')){
            if(file_exists(self::$brand->brand_image)){
                unlink(self::$brand->brand_image);
            }
            self::$imageUrl= self::getImageUrl($request);
        }else{
            self::$imageUrl= self::$brand->brand_image;
        }

        self::saveBasicInfo(self::$brand, $request, self::$imageUrl);
    }


    private static function saveBasicInfo($brand, $request, $imageUrl){
        $brand->brand_name= $request->brand_name;
        $brand->brand_image= $imageUrl;
        $brand->save();
    }
}
