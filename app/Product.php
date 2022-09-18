<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Image;

class Product extends Model
{
    protected $guard=[
        'section_id',
        'category_id',
        'product_name',
        'product_code',
        'product_color',
        'product_price',
        'product_discount',
        'product_weight',
        'product_video',
        'main_image',
        'short_description',
        'long_description',
        'wash_care',
        'fabric',
        'pattern',
        'sleeve',
        'fit',
        'occasion',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'is_featured',
        'status',
    ];
protected static $image,$imageName,$imageUrl,$product;
protected static $video,$videoName,$videoDirectory,$videoUrl;
protected static $small_image_path,$medium_image_path,$large_image_path;

    public function section(){
       return $this->belongsTo(Section::class); //product table foreng key section_id ase tai auto kaj krbe parameter bolte hobe (Section::class,'section_id'); avabe blte hbe na
    }

    public function brand(){
        return $this->belongsTo(Brand::class);
    }

    public function category(){
       return $this->belongsTo(Category::class);
    }

    public function attributes(){
        return $this->hasMany(ProductAttribute::class);
    }
    public function subImages(){
        return $this->hasMany(ProductImage::class);
    }

    public static function getImageUrl($request){
        self::$image= $request->file('main_image');
        if(self::$image){
            self::$imageName= $request->product_name.time().'.'.self::$image->getClientOriginalExtension();
            self::$small_image_path= 'images/product-image/small/'.self::$imageName;
            self::$medium_image_path= 'images/product-image/medium/'.self::$imageName;
            self::$large_image_path= 'images/product-image/large/'.self::$imageName;
            Image::make(self::$image)->resize(260,300)->save(self::$small_image_path);
            Image::make(self::$image)->resize(520,600)->save(self::$medium_image_path);
            Image::make(self::$image)->save(self::$large_image_path); //original e rakalm,, but width 1040 height 1200 rakte partam
            return self::$imageName;
        }else{
            return '';
        }
    }

    public static function getvideoUrl($request){
        self::$video= $request->file('product_video');
        if(self::$video){
            self::$videoName= $request->product_name.time().'.'.self::$video->getClientOriginalExtension();
           self::$videoDirectory= 'videos/product-video/';
           self::$video->move(self::$videoDirectory, self::$videoName);
           self::$videoUrl= self::$videoDirectory.self::$videoName;
            return self::$videoUrl;
        }else{
            return '';
        }
    }

    public static function addProduct($request){
        $productCodeExistsCheck= Product::where('product_code', $request->product_code)->first();
        if($productCodeExistsCheck){
            return redirect()->back()->with(['product_code' => $productCodeExistsCheck->product_code, 'exist_message' => ' This Product Code is already exists.!']);
        }

        self::$product= new Product();
        self::saveBasicInfo(self::$product, $request, self::getImageUrl($request), self::getvideoUrl($request));
    }

    public static function updateProduct($request, $id){
        self::$product= Product::find($id);
        // if er vitor dhoka mane product edit form theke notun kore video dise
        if($request->file('product_video')){
            //ai if diye check kore nilam db te video url nai
            if(self::$product->product_video == ""){
                self::$videoUrl= self::getvideoUrl($request);
            }else{
                if(file_exists(self::$product->product_video)){
                    unlink(self::$product->product_video);
                }
                self::$videoUrl = self::getvideoUrl($request);
            }
        }else{
            self::$videoUrl= self::$product->product_video;
        }

        // if er vitor dhoka mane product edit form theke notun kore video dise
        if($request->file('main_image')){
            //ai if diye check kore nilam db te video url nai
            if(self::$product->main_image == ""){
                self::$imageUrl= self::getImageUrl($request);
            }else{
                if(file_exists('images/product-image/large/'.self::$product->main_image)){
                    unlink('images/product-image/large/'.self::$product->main_image);
                    unlink('images/product-image/medium/'.self::$product->main_image);
                    unlink('images/product-image/small/'.self::$product->main_image);
                }
                self::$imageUrl = self::getImageUrl($request);
            }
        }else{
            self::$imageUrl= self::$product->main_image;
        }

        self::saveBasicInfo(self::$product, $request, self::$imageUrl, self::$videoUrl);
    }

    private static function saveBasicInfo($product, $request, $imageUrl, $videoUrl){
        //add product form theke sudu category id asbe tai sei category er section ta nilam
        $category= Category::where('id',$request->category_id)->first();
        $product->section_id = $category->section_id;
        $product->brand_id= $request->brand_id;
        $product->category_id = $request->category_id;
        $product->product_name = $request->product_name;
        $product->product_code = $request->product_code;
        $product->product_color = $request->product_color;
        $product->product_price = $request->product_price;
        $product->product_discount = $request->product_discount;
        $product->product_weight = $request->product_weight;
        $product->product_video = $videoUrl;
        $product->main_image = $imageUrl;
        $product->short_description = $request->short_description;
        $product->long_description = $request->long_description;
        $product->wash_care = $request->wash_care;
        $product->fabric = $request->fabric;
        $product->pattern = $request->pattern;
        $product->sleeve = $request->sleeve;
        $product->fit = $request->fit;
        $product->occasion = $request->occasion;
        $product->meta_title = $request->meta_title;
        $product->meta_description = $request->meta_description;
        $product->meta_keywords = $request->meta_keywords;
        if($request->is_featured == 'Yes'){
            $product->is_featured = $request->is_featured;
        }else{
            $product->is_featured = 'No';
        }
        $product->save();
    }


}
