<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Image;

class Admin extends Authenticatable
{
    use Notifiable;

protected $guard=['admin'];
    protected static $image,$imageName,$imageUrl,$directory;
    protected static $admin;

    protected $fillable = [
        'name', 'phone', 'type', 'email', 'password','image','status','created_at','updated_at',
    ];


    protected $hidden = [
        'password', 'remember_token',
    ];

    public static function getImageUrl($request){
        self::$image= $request->file('image');
        if(self::$image){
            self::$imageName= 'profile_img'.time().'.'.self::$image->getClientOriginalExtension();
            self::$directory= 'images/admin-image/';
           // self::$image->move(self::$directory, self::$imageName); ata laravel er deflt funtion avabe save krte directory er por ',' diye imageName
            self::$imageUrl= self::$directory.self::$imageName; //ata row php er moto path dite hoy kno space cara '.' diye concate kore ata intervention image pckage
           //avabe intervension package diye img save krle age obossoy manuali folder create krte hobe mane img je path a save hobe
            Image::make(self::$image)->resize(450,450)->save(self::$imageUrl);
            return self::$imageUrl;
        }
    }

    public static function updateAdminDetails($request){

        self::$admin= Admin::where('id', Auth::guard('admin')->user()->id)->first();
        if($request->hasFile('image')){
            if(file_exists(self::$admin->image)){
                unlink(self::$admin->image);
            }
            self::$imageUrl= self::getImageUrl($request);
        }else{
            self::$imageUrl= self::$admin->image;
        }

        self::$admin->name= $request->name;
        self::$admin->phone= $request->phone;
        self::$admin->image= self::$imageUrl;
        self::$admin->save();
    }

}
