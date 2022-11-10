<?php

namespace App\Http\Controllers\Admin;

use App\Coupon;
use App\Http\Controllers\Controller;
use App\Section;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CouponController extends Controller
{

    protected $selCats= [];
    protected $selUsers= [];
    protected $couponData;

    public function coupons(){
        Session::flash('active','coupon');
        $coupons= Coupon::orderBy('id','DESC')->get();
        return view('admin.coupons.coupons', ['coupons' => $coupons]);
    }

    public function updateCouponStatus(Request $request){
        $data= $request->all();

        if($data['status'] == 'Active'){
            $status= 0;
        }else{
            $status = 1;
        }

        Coupon::where('id',$data['coupon_id'])->update(['status' => $status]);
        return response()->json(['status' => $status]);
    }

    public function validateCoupon($request){
        if($request->coupon_option == 'Automatic'){
            $this->validate($request,[
                'coupon_option' => 'required',
                'categories'    =>  'required',
                'coupon_type'   =>  'required',
                'amount_type'   =>  'required',
                'amount'        =>  'required|numeric',
                'expiry_date'   =>  'required',
            ]);
        }else{
            $this->validate($request,[
                'coupon_option' => 'required',
                'coupon_code'   =>  'required',
                'categories'    =>  'required',
                'coupon_type'   =>  'required',
                'amount_type'   =>  'required',
                'amount'        =>  'required|numeric',
                'expiry_date'   =>  'required',
            ]);
        }
    }
    public function addEditCoupon(Request $request, $id=null){

        if($id == ""){
            $title= "Add Coupon";
        }else{
            $title= "Edit Coupon";
                //find coupon with edit coupon id
            $this->couponData= Coupon::find($id);
                //explode by koma old saved categories from db
            $this->selCats= explode(',', $this->couponData['categories']); // coupon er categories save korar somoy string kore save krci ',' koma diye tai explode krlam abe koma diye, explode kore array index a raklm
            //dd($this->selCats); die;

            //explode by koma old saved users from db
            $this->selUsers= explode(',', $this->couponData['users']);

            if($request->isMethod('post')){

                //validate coupon form,, here is calling above fuction and validate from validateCoupon functon
                $this->validateCoupon($request);

                //save coupon from coupon model
                Coupon::updateCoupon($request, $id);
                return redirect()->back()->with('message','Coupon Update Successfully');
            }
        }

        if($request->isMethod('post')){
                //validate coupon form,, here is calling above fuction and validate from validateCoupon functon
                $this->validateCoupon($request);

                //save coupon from coupon model
            Coupon::saveCoupon($request);
            return redirect()->back()->with('message','Coupon Added Successfully');
        }

        $sections= Section::all();
        $users= User::select('email')->where('status',1)->get();
        return view('admin.coupons.add-edit-coupon', [
            'sections' => $sections,
            'title' => $title,
            'users' => $users,
            'couponData' => $this->couponData,
            'selCats' => $this->selCats,
            'selUsers' => $this->selUsers,
        ]);

    }

    public function deleteCoupon($id){
        $coupon= Coupon::find($id);
        $coupon->delete();
        return redirect()->back()->with('message','Coupon Delete Successfully');
    }
}
