<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Auth;
use App\Cart;
use App\Mail\ForgotPasswordMail;
use App\Mail\VerifyMail;
use App\Mail\WelcomeMail;
use Illuminate\Support\Facades\Hash;
use Session;
use Illuminate\Support\Facades\Mail;

class AuthUserController extends Controller
{
    public function loginRegister()
    {

        return view('front.users.login-register');
    }

    public function userRegister(Request $request)
    {
        //ata laverl server validate
        $this->validate($request, [
            'name' => 'required|min:3',
            'email' => 'required|email',
            'mobile' => 'numeric',
            'password' => 'required|min:6',
        ]);

        $data = $request->all();

        //find user exists or not
        $userCount = User::where('email', $data['email'])->count();
        //check user exitst or not
        if ($userCount > 0) {
            return redirect()->back()->with('error_message', 'Email Already Exists Please Login');
        } else {

            //send email for user ata akta email proccess atar jonno make:mail WelcomeMail ata lage na
            // $email= $data['email'];
            // $messagedata=[
            //     'name'=>$data['name'],
            //     'email'=>$data['email'],
            //     'mobile'=>$data['mobile'],
            // ];
            // Mail::send('mail.welcome-mail',$messagedata,function($message) use ($email){
            //     $message->to($email);
            //     $message->subject('test mail');
            // });

            // new user register hosse mane save hosee
            $user = new User();
            $user->name = $data['name'];
            $user->email = $data['email'];
            $user->mobile = $data['mobile'];
            $user->password = Hash::make($data['password']);
            $user->status = 0;
            $user->save();

            //Email message data
            $email = $data['email'];
            $messagedata = [
                'name' => $data['name'],
                'email' => $data['email'],
                'code' => base64_encode($data['email']),
            ];

            //send mail to user
            Mail::to($email)->send(new VerifyMail($messagedata));
            return redirect()->back()->with('error_message', 'Registration Successfull,,Please Check your email to Active Account');

            //niche commnet kora code gula user login korar jnno agula user account active er por hobe tai ata cmnt kora
            //user regiser hole mane save hole take login kora hosse
            // if(Auth::attempt(['email' => $data['email'], 'password' => $data['password']])){
            //             //login hobar por check kora hosse user login er age cart a product add krce kina jodi add kore tahole seii cart table er user id update kore sob cart itmes cart a show kora hosse aii user er jnno,, session id jehuto login er age default 0 save kora hoy tai aii session ta niye login er ste ste cart table er userid 0 ta update kora hosse aii regiuster user id diye
            //         if(!empty(Session::get('session_id'))){
            //             $user_id= Auth::user()->id;
            //             $session_id= Session::get('session_id');
            //             Cart::where('session_id',$session_id)->update(['user_id' => $user_id]); //jeto jaygay ai current sessionid ase sob jaygay aii cuttent user id bose update hobe
            //         }
            //     return redirect('/cart');
            // }else{
            //     return redirect('/login-register');
            // }


        }
    }

    public function verifyEmail($code)
    {
        $email = base64_decode($code);
        $user = User::where('email', $email)->first();
        $messagedata=[
            'name' => $user->name,
            'email' => $user->email,
            'mobile' => $user->mobile,
        ];
        if ($user) {
            if($user->status == 1){
                return redirect('/login-register')->with('success_message', 'Your Account Alrady Actived Please Login');
            } else {
                User::where('email', $email)->update(['status' => 1]);
                Mail::to($email)->send(new WelcomeMail($messagedata));
                return redirect('/login-register')->with('success_message', 'Your Account Is Actived Please Login');
            }

        } else {
            abort(404);
        }
    }

    public function userLogin(Request $request)
    {
        //valide login form
        $this->validate($request, [
            'loginEmail' => 'required|email',
            'loginPassword' => 'required|min:6'
        ]);

        $data = $request->all();
        $user = User::where('email', $data['loginEmail'])->first();
        if ($user) {
            if ($user->status == 1) {
                if (Auth::attempt(['email' => $data['loginEmail'], 'password' => $data['loginPassword']])) {

                    //update cart table user id note: user jkhon login cara product addtocart button a click korbe sudu tokon e session_id ta set hobe Session::put('session_id',Session::get('session_id') avabe ata kora ase cartcontroller a product cart a save fuction a) tai akhane aii condition dilam je session_id empty na thkle oii session_id er under er product gula te aii user id ta set hobe,, karon akhn user login krce tai user id ta 0 thka jabe na,, r tai cart update krlam
                    if (!empty(Session::get('session_id'))) {
                        $user_id = Auth::user()->id;
                        $session_id = Session::get('session_id');
                        Cart::where('session_id', $session_id)->update(['user_id' => $user_id]);
                    }
                    return redirect('/cart');
                }
                else{
                    return back()->with('error_login', 'Password Incorrect');
                }
            }
            else {
                return back()->with('error_login', 'Your Account is not Active Please check your email and active account');
            }
        }
        else {
            return back()->with('error_login', 'Wrong Email Address,, You are not registered user');
        }
    }

    public function userLogout(Request $request)
    {
        if ($request->isMethod('post')) {
            Auth::logout();
            return redirect('/');
        }
    }


    public function signupEmailCheck(Request $request)
    {
        // if($request->ajax()){
        //     $data= $request->all();
        //     $userCount= User::where('email',$data['email'])->count();
        //     if($userCount > 0){
        //         $email= 'exists';
        //         return response()->json(['email' => $email]);
        //     }

        // }

        $data = $request->all();
        $userCount = User::where('email', $data['email'])->count();
        if ($userCount > 0) {
            return "false"; //ata true but jquery er jnno false kore dite hobe karon jquery reslt flse hoilei sudu eroor msg dey
        } else {
            return "true";
        }
    }
        public function passwordGenerate(){
            $data= ['A','#','$','X','1','@','*','9','c','F','u','V','b','5','2','Y'];
            $dataLen= count($data)-1;
            $password_len= 8;
            $result= '';
            for($i=0; $i<=$password_len; $i++){
                $rand_num= rand(0,$dataLen);
                $result= $result.$data[$rand_num];
            }

            return $result;
        }

    public function userForgotPassword(Request $request){
        if($request->isMethod('post')){
            $data= $request->all();
            $user= User::where('email',$data['email'])->first();
            if($user){
                $new_password= $this->passwordGenerate();
                $secure_password= bcrypt($new_password);
                $messagedata= [
                    'name' => $user->name,
                    'new_password' => $new_password,
                ];
                User::where('email',$data['email'])->update(['password' => $secure_password]);
                Mail::to($data['email'])->send(new ForgotPasswordMail($messagedata));
                return back()->with('success_message', 'Password Reset Successfully,, Please check your email for new login password');
            }else{
                return back()->with('error_message', 'This email is not exists our records');
            }
        }

        return view('front.users.forgot-password');
    }
}
