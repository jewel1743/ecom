<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrdersProduct extends Model
{
    use HasFactory;
        //product table er sate relation krci jodi product er image ba onno kisu need hoy tahole jeno sohoje pai
    public function product(){
        return $this->belongsTo(Product::class); //aii orders product table a product er id ase tai product er ste relation kore raklam
    }

    public static function saveOrderProducts($currentOrder){

        $cartItems= Cart::getCartItems();

        foreach($cartItems as $item){
            $ordersProducts= new OrdersProduct();
            $ordersProducts->order_id= $currentOrder->id;
            $ordersProducts->user_id= $currentOrder->user_id;
            $ordersProducts->product_id= $item['product_id'];
            $ordersProducts->product_code= $item['product']['product_code']; //cart item product id ase r cartgetitems function a with kore relation diye aii cart id er sate je prduct ase se pdct asbe every item er ste
            $ordersProducts->product_name= $item['product']['product_name'];
            $ordersProducts->product_color= $item['product']['product_color'];
            $ordersProducts->product_size= $item['size'];
                //get proudct size wise original price without if has discount
            $productMainAttributePrice= Cart::getAttributePrice($item['product_id'], $item['size']);
                //get product discount,, aii product er aii size a koto % discount ase ta clculation kore total amount get here
            $productDiscount= Cart::getProductDiscoutedPriceByAttribute($item['product_id'], $item['size']);
                // akhane product original price thke discount - krlm ata akn final product price
            $productFinalPrice= $productMainAttributePrice - $productDiscount;

            $ordersProducts->product_price= $productFinalPrice;
            $ordersProducts->product_quantity= $item['quantity'];
            $ordersProducts->save();
        }
    }
}
