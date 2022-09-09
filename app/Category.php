<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    protected $fillable=
    [
        'parent_id',
        'section_id',
        'category_name',
        'category_image',
        'category_discount',
        'description',
        'url',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'status',
    ];

    protected static $image,$imageName,$imageUrl,$directory;
    protected static $category;

    public static function getImageUrl($request){
        self::$image= $request->file('category_image');
        if(self::$image){
            self::$imageName= 'category_img'.time().'.'.self::$image->getClientOriginalExtension();
            self::$directory= 'images/category_img/';
            self::$imageUrl= self::$directory.self::$imageName;
            self::$image->move(self::$directory, self::$imageName);
            return self::$imageUrl;
        }else{
            return '';
        }
    }
    public static function saveCategory($request){
        self::$category= new Category();
        self::saveBasicInfo(self::$category, $request, self::getImageUrl($request));
    }

    public static function editCategory($request, $id){
        self::$category= Category::find($id);
        if($request->file('category_image')){
            if(file_exists(self::$category->category_image)){
                unlink(self::$category->category_image);
            }
            self::$imageUrl= self::getImageUrl($request);
        }
        else{
            self::$imageUrl= self::$category->category_image;
        }

        self::saveBasicInfo(self::$category, $request,self::$imageUrl);
    }


    private static function saveBasicInfo($category, $request, $imgUrl){
        $category->parent_id= $request->parent_id;
        $category->section_id= $request->section_id;
        $category->category_name= $request->category_name;
        $category->category_image= $imgUrl;
        $category->category_discount= $request->category_discount;
        $category->description= $request->description;
        $category->url= $request->url;
        $category->meta_title= $request->meta_title;
        $category->meta_description= $request->meta_description;
        $category->meta_keywords= $request->meta_keywords;
        $category->save();
    }

    public function subCategory(){
        return $this->hasMany(Category::class, 'parent_id')->where('status', 1); //category table er primary key jdi kono category table er parent_id hoy tahole se row gula return krbe
    }

    public function section(){
        return $this->belongsTo(Section::class); //ai category table er sectio_id filed er value section table er je primay key field er value sathe ak hobe se akta row return krbe
    }


    public function parentCategory(){
        return $this->belongsTo(Category::class, 'parent_id'); //akhae ->select('id','name') avabe deya jabe jodi nirdisto kisu lage sob na niye..
    }
}
