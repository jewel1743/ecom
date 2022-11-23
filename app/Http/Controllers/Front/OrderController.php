<?php

namespace App\Http\Controllers\Front;

use App\Cart;
use App\Coupon;
use App\DeliveryAddress;
use App\Http\Controllers\Controller;
use App\Order;
use App\OrdersProduct;
use Illuminate\Http\Request;
use Session;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    public function placeOrder(Request $request){
        if($request->isMethod('post')){
            $data= $request->all();
            if(!isset($data['address_id'])){
                return redirect()->back()->with('error_message','Please Add Delivery Address and Select');
            }
            if(!isset($data['payment'])){
               return redirect()->back()->with('error_message','Please Select a Payment Method');
            }

            if($data['payment'] == 'Cod'){
                $payment_method= 'Cod';
            }else{
                $payment_method= 'Prepaid';
            }

            // get delivery address
            $delivery_address= DeliveryAddress::where('id',$data['address_id'])->first();

           // DB::beginTransaction(); ata akhane kaj krbe nah ata use hoito tokn jokon akta function er vitor aii order save korbo abong aii ordersprodct o save krbo tokon lagto more  details ecom seris 130nmber vdieo
                //save order info from order model
           $currentSavedOrder= Order::saveOrder($delivery_address, $request,$payment_method);

                //save current order er product,, mane akn e je oder ta save holo sei order er id diye user sob cart er product save krbo
            OrdersProduct::saveOrderProducts($currentSavedOrder);
            
                //forget coupon code applying session
                Session::forget('couponAmount');
                Session::forget('amount_type');
                Session::forget('coupon_code');

           Session::put('order_id',$currentSavedOrder->id);
           Session::put('grand_total',$data['grand_total']);
           // DB::commit();
            if($payment_method == 'Cod'){
                //send emial to user
                $orderDetails= Order::with('orders_products')->where('id',$currentSavedOrder->id)->first()->toArray();
               // echo '<pre>'; print_r($orderDetails); die;
                $email= Auth::user()->email;
                $coupon= Coupon::where('coupon_code', $orderDetails['coupon_code'])->first();
                if($coupon){
                    $couponAmountType= $coupon->amount_type;
                }else{
                    $couponAmountType= '';
                }
                $messageData=[
                    'name' => Auth::user()->name,
                    'order_id' => $currentSavedOrder->id,
                    'orderDetails' => $orderDetails,
                    'couponAmountType' => $couponAmountType
                ];

                Mail::send('mail.order-mail',$messageData, function($message) use ($email){
                    $message->to($email)->subject('Order Placed -Ecom');
                });
                return redirect(route('front-thanks'));
            }else{
                return 'Comming Soon';
            }

        }
    }

    public function thanks(){
        if(Session::has('order_id')){

                //delete cart item this user after saved order
                Cart::where('user_id',Auth::user()->id)->delete();
            return view('front.checkout.thanks');
        }else{
            return redirect(route('front-cart-page'));
        }
    }

    public function orders(){
            //to array kore aii kaj korlam tai relation a with diye relattion fnctin er name dilam
        $orders= Order::with('orders_products')->where('user_id', Auth::user()->id)->orderBy('id','DESC')->get()->toArray();
       // dd($orders); die;
        return view('front.orders.orders',['orders' => $orders]);
    }

    public function orderDetails($order_id){
            //laravel er relation jmn tahke temon vabe kaj krlm json object hisebe,, json object first tai with diye relation niye jete hobe na view te objct dhore call korlei hobe ex: eii view te
        $ordersDetails= Order::where('id', $order_id)->where('user_id',Auth::user()->id)->firstOrFail(); //firstOrFail ata hosse data asle akta row return krbe r na asle 404 page return korbe
            //ata amar mastani kore ber kora avabe aii coupon code er option ta
        $coupon= Coupon::select('amount_type')->where('coupon_code',$ordersDetails->coupon_code)->first();
        return view('front.orders.order_details',['ordersDetails' => $ordersDetails, 'coupon' => $coupon]);


    }
}
