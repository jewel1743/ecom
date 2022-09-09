<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductAttribute extends Model
{
    protected $guard=['product_id','size','sku','price','status'];
    protected static $data;
    protected static $skuExistCheck;
    protected static $sizeExistCheck;
    protected static $productAttribute;

    public static function saveProductAttribute($request, $id){
        self::$data= $request->all();

        foreach(self::$data['sku'] as $key => $value){

            if(!empty($value)){

                self::$skuExistCheck= ProductAttribute::where('sku', $value)->first();
                if(self::$skuExistCheck){
                    return redirect()->back()->with(['existValue' => $value, 'exist_message' => ' This SKU already exist']);
                }

                self::$sizeExistCheck= ProductAttribute::where(['product_id' => $id, 'size' => self::$data['size'][$key]])->first();
                if(self::$sizeExistCheck){
                    return redirect()->back()->with(['existValue' => self::$sizeExistCheck->size, 'exist_message' => ' This Size already exist']);
                }

                self::$productAttribute= new ProductAttribute();
                self::$productAttribute->product_id= $id;
                self::$productAttribute->sku= $value;
                self::$productAttribute->size= self::$data['size'][$key];
                self::$productAttribute->price= self::$data['price'][$key];
                self::$productAttribute->stock= self::$data['stock'][$key];
                self::$productAttribute->save();
            }
        }

        return redirect()->back()->with('message', 'Product attribute added successfully');
    }
}
