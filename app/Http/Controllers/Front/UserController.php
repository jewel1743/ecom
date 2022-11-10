<?php

namespace App\Http\Controllers\Front;

use App\City;
use App\Country;
use App\District;
use App\Division;
use App\Http\Controllers\Controller;
use App\State;
use App\Union;
use App\Upazila;
use App\User;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(){

        //for Bangladesh
        $divisions= Division::all()->toArray();
        $user_id= Auth::user()->id;
        $userInfo= User::where('id',$user_id)->first();
        //return $userInfo;
                //tecnic
            if(!empty($userInfo['division'])){
                $userDivision= Division::where('id', $userInfo['division'])->first(); //userInfo division a division id ase tai $userInfo['division'] dilam
            }else{
                $userDivision= '';
            }
            if(!empty($userInfo['district'])){
                $userDistrict= District::where('id', $userInfo['district'])->first(); //userInfo division a division id ase tai $userInfo['division'] dilam
            }else{
                $userDistrict= '';
            }
            if(!empty($userInfo['upazila'])){
                $userUpazila= Upazila::where('id', $userInfo['upazila'])->first(); //userInfo division a division id ase tai $userInfo['division'] dilam
            }else{
                $userUpazila= '';
            }

            // if(!empty($userInfo['district'])){
            //     $districts= District::where('district_id', $userInfo['division'])->get()->toArray(); //userInfo division a division id ase tai $userInfo['division'] dilam
            // }else{
            //     $districts= '';
            // }
            // if(!empty($userInfo['division'])){
            //     $districts= District::where('division_id', $userInfo['division'])->get()->toArray(); //userInfo division a division id ase tai $userInfo['division'] dilam
            // }else{
            //     $districts= '';
            // }

        return view('front.users.user-account',[
            'divisions' => $divisions,
            'userInfo' => $userInfo,
            'userDivision' => $userDivision,
            'userDistrict' => $userDistrict,
            'userUpazila' => $userUpazila,
        ]);
            //for international bellow codes
       // $countries= Country::where('status', 1)->get()->toArray();

            //test perposer example for select query
    //   $countries = Country::select('id','name')->with(['states' => function($query){
    //                 $query->select('country_id','id','name')->where('status', 1); //onek somoy select korle select hoyna faka array ase,, tokon jei relation er under thkbe ta filed er name ta dite hobe jemon akahne country_id use krci country table er under thaka state table er country_id
    //             }])->where('status', 1)->get()->toArray();

            //test perposer example for select query
    //   $states = State::select('id','name')->with(['cities' => function($query){
    //                  $query->select('state_id','id','name')->where('status', 1); //onek somoy select korle select hoyna faka array ase,, tokon jei relation er under thkbe ta filed er name ta dite hobe jemon akahne state_id use krci country table er under thaka state table er country_id
    //              }])->where('status', 1)->get()->toArray();

        //return view('front.users.user-account',['countries' => $countries]);
    }

    // public function getState(Request $request){
    //     if($request->ajax()){
    //         $data= $request->all();
    //         $states= State::select('id','name')->where('country_id', $data['country_id'])->orderBy('name','ASC')->get()->toArray();
    //         return view('front.users.appned-state',['states' => $states]);
    //     }
    // }

    // public function getCity(Request $request){
    //     if($request->ajax()){
    //         $data= $request->all();
    //         $cities= City::select('id','name')->where('state_id', $data['state_id'])->orderBy('name','ASC')->get()->toArray();
    //         return view('front.users.append-city',['cities' => $cities]);
    //     }
    // }

    public function getDistrict(Request $request){
        if($request->ajax()){
            $data= $request->all();
            $districts= District::select('id','name','bn_name')->where('division_id', $data['division_id'])->orderBy('name','ASC')->get()->toArray();
            return view('front.users.append-districts',['districts' => $districts]);
        }
    }
    public function getUpazila(Request $request){
        if($request->ajax()){
            $data= $request->all();
            $upazilas= Upazila::select('id','name','bn_name')->where('district_id', $data['district_id'])->orderBy('name','ASC')->get()->toArray();
            return view('front.users.append-upazila',['upazilas' => $upazilas]);
        }

    }

    public function getUnion(Request $request){
        if($request->ajax()){
            $data= $request->all();
            $unions= Union::select('id','name','bn_name')->where('upazilla_id', $data['upazilla_id'])->orderBy('name','ASC')->get()->toArray();
            return view('front.users.append-union',['unions' => $unions]);
        }

    }

    public function updateUserInfo(Request $request, $id){
        if($request->isMethod('post')){
            //     simple validate without cstm mssage
            // $this->validate($request, [
            //     'name' => 'required|regex:/^[a-zA-Z\s]*$/',
            //     'mobile' => 'required|numeric'
            // ]);

                //with cstm mssage
            $rules=[
                'name' => 'required|regex:/^[a-zA-Z\s]*$/',
                'mobile' => 'required|numeric',
                'division' => 'required',
                'district' => 'required',
                'upazila' => 'required',
                'union' => 'required',
                'address' => 'required',
            ];
            $customMessage=[
                'name.required' => 'Name field is required',
                'name.regex' => 'Please input valid name without Number',
            ];
                //valide form data
            $this->validate($request, $rules, $customMessage);
                //form data
            $data= $request->all();

                //find user and update user
            $user= User::find($id);
            $user->name= $data['name'];
            $user->mobile= $data['mobile'];
            $user->pincode= $data['pincode'];
            $user->address= $data['address'];
            $user->division= $data['division'];
            $user->district= $data['district'];
            $user->upazila= $data['upazila'];
            $user->unions= $data['union'];
            $user->save();
            return redirect()->back()->with('success_message','Account Update Successfully');
        }
    }


    public function updatePassword(Request $request){
        if($request->isMethod('post')){
                //validate update password form
            $this->validate($request,[
                'currentPassword' => 'required',
                'newPassword' => 'required|min:6',
                'confirmPassword' => 'required|same:newPassword'
            ]);

           $data= $request->all();
           $password= Auth::user()->password;
                //make hash pass user normal pass
            $newPassword= Hash::make($data['newPassword']);

           if(Hash::check($data['currentPassword'], $password)){
                    //check user newpassword and old password is same input again?
                if(Hash::check($data['newPassword'], $password)){
                    return redirect()->back()->with('error_message', 'Your new password and old password are same.! Use another password from old password');
                }
                        //update password
                User::where('id',Auth::user()->id)->update(['password' => $newPassword]);
                return redirect()->back()->with('success_message', 'Password Update Successfully');

           }else{
                return redirect()->back()->with('error_message', 'Current Password is Incorrect');
           }
        }
    }

    public function currentPasswordCheck(Request $request){
        $currentPassword= $request->currentPassword;
        $password= Auth::user()->password;
        if(Hash::check($currentPassword, $password)){
            return 'true';
        }else{
            return 'false';
        }

    }


}
