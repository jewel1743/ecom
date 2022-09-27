<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $guard=['image','title','link','alt','status'];
    protected static $image,$imageName,$directory,$imageUrl,$banner;

    public static function getImageUrl($request){
        self::$image= $request->file('image');
        if(self::$image){
            self::$imageName= 'banner'.'_'.time().'.'.self::$image->getClientOriginalExtension();
            self::$directory= 'images/banners/';
            self::$image->move(self::$directory, self::$imageName);
            self::$imageUrl= self::$directory.self::$imageName;
            return self::$imageUrl;
        }else{
            return '';
        }
    }

    public static function saveBanner($request){
        self::$banner= new Banner();
        self::saveBasicInfo(self::$banner, $request, self::getImageUrl($request));
    }

    public static function updateBanner($request, $id){
        self::$banner= Banner::find($id);
        if($request->hasfile('image')){
            if(file_exists(self::$banner->image)){
                unlink(self::$banner->image);
            }
            self::$imageUrl= self::getImageUrl($request);
        }else{
            self::$imageUrl= self::$banner->image;
        }

        self::saveBasicInfo(self::$banner, $request, self::$imageUrl);
    }


    private static function saveBasicInfo($banner, $request, $imageUrl){
        $banner->image= $imageUrl;
        $banner->title= $request->title;
        $banner->link= $request->link;
        $banner->alt= $request->alt;
        $banner->save();
    }
}
