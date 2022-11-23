<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Session;

class Order extends Model
{
    use HasFactory;
    protected $dates= ['created_at'];
        //relation with ordersproduct table
    public function orders_products(){
        return $this->hasMany(OrdersProduct::class); //aii order id er joto gula ordersproducts table er product ase sob retun krbe
    }

    public function user_info(){
        return $this->belongsTo(Order::class, 'user_id'); //onk somoy relation key na dile ase na, tai dilam, order::class ta hosse primary key r 'user_id' ta forgen key mane user_id er id number ta order ta table er id jeta hobe se row retun korbe atai relation
    }

    public static function saveOrder($delivery_address, $request,$payment_method){

        $delivery_address= $delivery_address;
        $data= $request->all();

        $order= new Order();

        $order->user_id= Auth::user()->id;
        $order->name= $delivery_address->name;
        $order->address= $delivery_address->address;
        $order->city= $delivery_address->city;
        $order->district= $delivery_address->district;
        $order->division= $delivery_address->division;
        $order->pincode= $delivery_address->pincode;
        $order->mobile= $delivery_address->phone;
        $order->email= Auth::user()->email;
        $order->shipping_charge= 0;
        $order->coupon_code= Session::get('coupon_code');
        $order->coupon_amount= Session::get('couponAmount');
        $order->order_status= "new";
        $order->payment_method= $payment_method;
        $order->payment_gateway= $data['payment'];
        $order->grand_total= $data['grand_total'];
        $order->save();
        return $order;
        //jodi current order save kore sudu sei order er id lage tahole DB::getPdo->lastInsertId ata cll krlei retun krto last insert id db tble er
        //more info ecom series vdo 130nmber vdo
    }
}
