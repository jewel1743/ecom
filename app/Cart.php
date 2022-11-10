<?php

namespace App;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;
use Session;

class Cart extends Model
{
    use HasFactory;
    protected $guard=['session_id','product_id','user_id','size','quantity'];
    public static function getCartItems(){
        if(Auth::check()){
            $cartItems= Cart::with('product')->where('user_id', Auth::user()->id)->orderBy('id','DESC')->get()->toArray(); //toArary use krle with diye relation er data nite hoy r toArray use na krle view te giye ex:items as item tar por item->product->name avabe dilei ase
        }else{
            $cartItems= Cart::with('product')->where('session_Id', Session::get('session_id'))->orderBy('id','DESC')->get()->toArray();
        }

        return $cartItems;
    }

    public function product(){
        return $this->belongsTo(Product::class); //ai cart table a product_Id name a akta colom neya ase tai belongsto product use krlm product er info neyar jnno
    }

    public static function getAttributePrice($prouduct_id, $size){
       $getPrice= ProductAttribute::where(['product_id' => $prouduct_id, 'size' => $size])->first();
       return $getPrice->price;
    }
    public static function getAttributeStock($prouduct_id, $size){
       $getStock= ProductAttribute::where(['product_id' => $prouduct_id, 'size' => $size])->first();
       return $getStock->stock;
    }

    public static function getProductDiscoutedPriceByAttribute ($prouduct_id, $size){
        $attribe= ProductAttribute::where(['product_id' => $prouduct_id, 'size' => $size])->first()->toArray();
        $product= Product::where('id', $prouduct_id)->first()->toArray();
        $category= Category::where('id', $product['category_id'])->first()->toArray();

        if($product['product_discount'] > 0){
            $discounted_price= ($attribe['price'] * $product['product_discount']) / 100; // single product discount ta koto hosse seta ber korlam ,, mane aii product er discount ta koto passi seta ber korlam ,, akn cart page a aii discount dite tolal customer quantity * krbo tahole 3 pcs nile 3ps er discount amount dekhabe
        }
        else if($category['category_discount'] > 0){
            $discounted_price= ($attribe['price'] * $category['category_discount']) / 100;
        }else{
            $discounted_price= 0;
        }

        return $discounted_price;

    }

        //app/Helpers/helpers.php class baniye ata use krci tai akhane cmnt kore rakci
    // public static function sumCartItems(){
    //     if(Auth::check()){
    //         $sumCartItems= Cart::where('user_id', Auth::user()->id)->sum('quantity');
    //     }
    //     else if(!empty(Session::get('session_id'))){
    //         $sumCartItems= Cart::where('session_id', Session::get('session_id'))->sum('quantity');
    //     }else{
    //         $sumCartItems = 0;
    //     }

    //     return $sumCartItems;
    // }
}
