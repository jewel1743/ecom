<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Image;

class ProductImage extends Model
{

    protected static $images, $image,$imageName,$imageUrl,$product,$productImage;
    protected static $sub_image_path;

    public static function getImageUrl($product,$image){

        if($image){
            self::$imageName= $product->product_name.time().rand(111,999).'.'.$image->getClientOriginalExtension();
            $directory= 'images/product-image/sub-images/';
            $image->move($directory, self::$imageName);
                //for intervention image package save system
           // self::$sub_image_path= 'images/product-image/sub-images/'.self::$imageName;
           // Image::make($image)->save(self::$sub_image_path);
            return self::$imageName;
        }else{
            return '';
        }
    }

    public static function saveImages($request, $id){
        self::$product= Product::find($id);
        self::$images = $request->file('images');
        if(self::$images){
            foreach(self::$images as $image){
                $extension= $image->getClientOriginalExtension();
               if($extension != 'jpg' && $extension != 'png'){
                    return back()->with('error_message', 'Please Select jpg or png file');
               }else{
                    self::$productImage= new ProductImage();
                    self::$productImage->product_id=  $id;
                    self::$productImage->images= self::getImageUrl(self::$product, $image);
                    self::$productImage->save();
               }
            }


        }
    }
}
