<?php

namespace App\Http\Controllers\Front;

use App\Cart;
use App\DeliveryAddress;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Session;

class CheckoutController extends Controller
{
    protected $deliveryData;

    public function checkout(){
        $cartItems= Cart::getCartItems();
        $deliveryAddresses= DeliveryAddress::where('user_id', Auth::user()->id)->get();
        $page= 'checkout';
        return view('front.checkout.checkout',['cartItems' => $cartItems, 'deliveryAddresses' => $deliveryAddresses, 'page' => $page]);
    }

    public function addEditDeliveryAddress(Request $request, $id=null){

        if($id == ""){
            $title= "Create Delivery Address";
        }else{

            $title= "Edit Delivery Address";

            $this->deliveryData= DeliveryAddress::find($id);
            if($request->isMethod('post')){

                $this->validate($request, [
                    'name' => 'required',
                    'address' => 'required',
                    'city' => 'required',
                    'district' => 'required',
                    'division' => 'required',
                    'phone' => 'required|numeric',
                   ]);
                $deliveryAddresses= DeliveryAddress::find($id);
                $deliveryAddresses->user_id= Auth::user()->id;
                $deliveryAddresses->name= $request->name;
                $deliveryAddresses->address= $request->address;
                $deliveryAddresses->city= $request->city;
                $deliveryAddresses->district= $request->district;
                $deliveryAddresses->division= $request->division;
                $deliveryAddresses->phone= $request->phone;
                $deliveryAddresses->save();
                return redirect()->back()->with('message', 'Delivery Address Update Successfully');
            }
        }

        if($request->isMethod('post')){

           $this->validate($request, [
            'name' => 'required',
            'address' => 'required',
            'city' => 'required',
            'district' => 'required',
            'division' => 'required',
            'phone' => 'required|numeric',
           ]);

           $deliveryAddresses= new DeliveryAddress();

           $deliveryAddresses->user_id= Auth::user()->id;
           $deliveryAddresses->name= $request->name;
           $deliveryAddresses->address= $request->address;
           $deliveryAddresses->city= $request->city;
           $deliveryAddresses->district= $request->district;
           $deliveryAddresses->division= $request->division;
           $deliveryAddresses->phone= $request->phone;
           $deliveryAddresses->save();

           return redirect()->back()->with('message', 'Delivery Address Create Successfully');
        }

        return view('front.checkout.add-edit-delivery-address',['title' => $title, 'deliveryData' => $this->deliveryData]);
    }

    public function deleteDeliveryAddress(Request $request){
        if($request->ajax()){
            $data= $request->all();
            $address= DeliveryAddress::find($data['recordId']);
            $address->delete();
            return response()->json(['status' => 1]);
        }
    }

}
