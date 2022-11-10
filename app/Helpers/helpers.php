<?php
use App\Cart;
    //akahne public privte protected agula age na dileo hobe
 function sumCartItems(){
    if(Auth::check()){
        $cartItems= Cart::where('user_id',Auth::user()->id)->sum('quantity');
    }else{
        $cartItems= Cart::where('session_id',Session::get('session_id'))->sum('quantity');
    }

    return $cartItems;
 }

 
