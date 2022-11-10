<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;
    protected $dates= ['expiry_date'];
    public static function saveCoupon($request){
        $data= $request->all();

        if($data['coupon_option'] == 'Automatic'){
            $coupon_code= str_random(8);
        }else{
            $coupon_code= $data['coupon_code'];
        }

        $categories= implode(',', $data['categories']); //categories r users akta array jkn multiple select krbe segula array index a thke r akhne implode diye protita index er vlue ',' diye diye sting hoye akhn thkbe ai implode er jnno

        if(isset($data['users'])){
            $users= implode(',', $data['users']);
        }else{
            $users = "";
        }


        $coupon= new Coupon();
        $coupon->coupon_option= $data['coupon_option'];
        $coupon->coupon_code= $coupon_code;
        $coupon->categories= $categories;
        $coupon->users= $users;
        $coupon->coupon_type= $data['coupon_type'];
        $coupon->amount_type= $data['amount_type'];
        $coupon->amount= $data['amount'];
        $coupon->expiry_date= $data['expiry_date'];
        $coupon->status= 0;
        $coupon->save();
    }

    public static function updateCoupon($request, $id){
        $data= $request->all();
        $coupon= Coupon::find($id);

        if($data['coupon_option'] == 'Automatic'){
            $coupon_code= $coupon['coupon_code']; //ata ager databse a jeta save ase setai abar save krlam
        }else{
            $coupon_code= $data['coupon_code'];
        }

        $categories= implode(',', $data['categories']); //categories r users akta array jkn multiple select krbe segula array index a thke r akhne implode diye protita index er vlue ',' diye diye sting hoye akhn thkbe ai implode er jnno

        if(isset($data['users'])){
            $users= implode(',', $data['users']);
        }else{
            $users = "";
        }

        $coupon->coupon_option= $data['coupon_option'];
        $coupon->coupon_code= $coupon_code;
        $coupon->categories= $categories;
        $coupon->users= $users;
        $coupon->coupon_type= $data['coupon_type'];
        $coupon->amount_type= $data['amount_type'];
        $coupon->amount= $data['amount'];
        $coupon->expiry_date= $data['expiry_date'];
        $coupon->save();
    }
}
