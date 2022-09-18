<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use App\Http\Controllers\Controller;
use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class AdminController extends Controller
{
    private $data;
    public function login(Request $request){
        if($request->isMethod('post')){

            //ata jekumo veriable hoite pare and atate sob validation rules bole dite hobe as like requst validte a boltam
            $rules=[
                'email' => 'required|email',
                'password' => 'required|min:8',
            ];

                //amar jei msg ta custom dorkam ami sudu setao dite pari sob gula fielf custom na diye
            $customMsg=[
                'email.required' => 'Email Is Required',
                'email.email' => 'Please Enter Valid Email',
                'password.required' => 'Password is Required',
                'password.min' => 'Password minimum 8 length',
            ];

            $this->validate($request,$rules,$customMsg);

            $this->data= $request->all();
            if(Auth::guard('admin')->attempt(['email' => $this->data['email'], 'password' => $this->data['password']])){

                return redirect('/admin/dashboard');
            }else{
                return redirect()->back()->with('message', 'Wrong Credentials');
            }
        }
        return view('admin.login.login');
    }

    public function settings(){
        Session::flash('active', 'settings');
        $admin= Admin::where('email', Auth::guard('admin')->user()->email)->first();
        return view('admin.home.settings',['admin' => $admin]);
    }

    public function dashboard(){
        Session::flash('active', 'dashboard');
        return view('admin.home.home');
    }

    public function logout(){
        Auth::guard('admin')->logout();
        return redirect('/admin/login');
    }

    public function checkCurrentPassword(Request $request){

        $currentPwd= $request->currentPwd; //ajax a input fld thke je passwd niye send krci data thke
        $adminPassword= Auth::guard('admin')->user()->password; //current logged user password
        //fst pramiter nrml psswr and scd prmtr hash psswd
       if(Hash::check($currentPwd, $adminPassword)){
            return 'true';
       }else{
            return 'false';
       }

    }

    public function updatePassword(Request $request){
        Session::flash('active', 'updatePassword');
        $this->validate($request,[
            'current_password' => 'required',
            'new_password' => 'required|min:8',
            'confirm_password' => 'required|same:new_password',
        ]);

        $currentPwd= $request->current_password;
        $adminPassword= Auth::guard('admin')->user()->password;
        $newPassword= Hash::make($request->new_password);
       if(Hash::check($currentPwd, $adminPassword)){
            if($request->new_password == $request->confirm_password){
                Admin::where('id',Auth::guard('admin')->user()->id)->update(['password' =>  $newPassword]);
                return redirect()->back()->with('success', 'Password Update Successfully');
            }else{
                return redirect()->back()->with('message', 'Confirm Password Not Match');
            }
       }else{
            return redirect()->back()->with('message', 'Confirm Password Is Incorrect');
       }
    }

    public function adminDetailsValidation($request){
        $rules=[
            'name' => 'required|regex:/^[\pL\s]+$/u|min:3',
            'phone' => 'required|regex:/(01)[0-9]{9}$/',
            'image' => 'mimes:jpg,png',
        ];

        $customMsg=[
            'name.required' => 'Please Enter Valid Name',
            'name.regex' => 'Allow Only Cherecter And Space',
            'phone.required' => 'Phone is required',
            'phone.regex' => 'Please Enter Valid phone Number',
            'image.mimes' => 'Please Select jpg or png Images file',
        ];

        $this->validate($request,$rules,$customMsg);
    }

    public function adminUpdateDetails(Request $request){
        Session::flash('active', 'adminDetails');
        if($request->isMethod('post')){

            //admin details vlidate krlm fction diye
            $this->adminDetailsValidation($request);

            Admin::updateAdminDetails($request);
            return redirect()->back()->with('message', 'Admin Details Update Successfully');
        }

        return view('admin.home.update-admin-details');
    }
}

