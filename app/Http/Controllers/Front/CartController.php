<?php

namespace App\Http\Controllers\Front;

use App\Cart;
use App\Coupon;
use App\Http\Controllers\Controller;
use App\Product;
use App\ProductAttribute;
use App\User;
use Illuminate\Http\Request;
use Session;
use Auth;
use Illuminate\Support\Facades\View;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        if ($request->isMethod('post')) {
            //validation add to cart
            $this->validate($request, [
                'quantity' => 'required|min:1|numeric',
                'size' => 'required',
            ]);

            $data = $request->all();
            //product id and  product er size diye attribute find kore nilam
            $attribute = ProductAttribute::where(['product_id' => $data['product_id'], 'size' => $data['size']])->where('status', 1)->first(); //kew jodi inspact eliment kore onno size likhe dey jeta amager db te nei ba status 0 kora ase tahole jeno na hoy tai ata use krlm amr nij thke
            //attribute jodi pay taholei if a dukbe
            if ($attribute) {
                //user je size ta select korce sei size er amar stock ke thaka amount ta ber kore nilam
                $getSelectSizeStock = $attribute->stock;
                //check user selected size Quantity as our stock quatites are availabe or not
                if ($getSelectSizeStock < $data['quantity']) {
                    return redirect()->back()->with('error_message', 'Sorry,, Requred Stock Not Available our Store, please some reduce your quantity');
                }
                //user er current session id ta nilam
                $session_Id = Session::get('session_id');
                //opore $session_Id ta set na thakle akhane put kore dilam mane set kore dilam
                if (empty($session_Id)) {
                    $session_Id = Session::getId();
                    Session::put('session_id', $session_Id);
                }

                //if user is logged
                if (Auth::check()) {
                    //check product size exists in cart
                    //product id and user id and size diye find
                    $sizeExistInCart = Cart::where(['product_id' => $data['product_id'], 'user_id' => Auth::user()->id, 'size' => $data['size']])->count();
                    $user_id = Auth::user()->id;
                } else {
                    //if user not logged or un registered user
                    //product id and sesion id and size diye find
                    $sizeExistInCart = Cart::where(['product_id' => $data['product_id'], 'session_id' => $session_Id, 'size' => $data['size']])->count();
                    $user_id = 0;
                }


                //avbeo save kora jay ata exaple
                // Cart::insert(['session_id' => $session_Id, 'user_id' => 0, 'product_id' => $data['product_id'], 'size' => $data['size'], 'quantity' => $data['quantity']]); //avabe insert kora jay but ata valo na
                //check user selected size product already exist or not in cart
                if ($sizeExistInCart > 0) {
                    return redirect()->back()->with('error_message', 'This size exists in cart');
                }
                //save product in cart
                $cart = new Cart();
                $cart->session_id = $session_Id;
                $cart->user_id = $user_id;
                $cart->product_id = $data['product_id'];
                $cart->size = $data['size'];
                $cart->quantity = $data['quantity'];
                $cart->save();

                return redirect()->back()->with('message', 'Product Added To Cart');
            } else {
                return back()->with('error_message', 'Sorry,, This Size is not Availabe our records');
            }
        }
    }


    public function cartPage()
    {

        $cartItems = Cart::getCartItems();
        return view('front.products.cart', ['cartItems' => $cartItems]);
    }

    public function updateCart(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            $cart = Cart::find($data['cartId']);
            $cart->quantity = $data['new_quantity'];
            $cart->save();

            //after update cart and new updateed cart items get again
            $cartItems = Cart::getCartItems();
            // $sumCartItems= Cart::sumCartItems(); ata Cart model er ta use krcilm tai cmnt krlm
            $sumCartItems = sumCartItems(); //ata helpers.php er function tai aii app er jekono jaygay use krte parbo view class sob khanei
            //avabeo view return kora jay
            //return response()->json(['view' => (String)View::make('front.products.cart-items', ['cartItems' => $cartItems])]); //avabe view return kora jay kono aray er index a oii index aii view thakbe
            // return view('front.products.cart-items',['cartItems' => $cartItems,]);
            return response()->json(['view' => (string)View::make('front.products.cart-items', ['cartItems' => $cartItems]), 'sumCartItems' => $sumCartItems]); // cart page view and sathe r akta key value pathalam buddhi kore ,, avabe view return krle opore Illuminate\Support\Facades\View; ata use kore nite hobe

        }
    }

    public function deleteCartItem(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            $cart = Cart::where('id', $data['cart_id'])->first();
            $cart->delete();
            $cartItems = Cart::getCartItems();
            // $sumCartItems= Cart::sumCartItems(); ata Cart model er ta use krcilm tai cmnt krlm, //opore cart page a new quntity update hosse tai niche new update quntity ta niye cart page a jassi sumcartitem ajax er maddome update krar jnno
            $sumCartItems = sumCartItems();
            //return view('front.products.cart-items',['cartItems' => $cartItems]);
            return response()->json(['view' => (string)View::make('front.products.cart-items', ['cartItems' => $cartItems]), 'sumCartItems' => $sumCartItems]);
        }
    }

    public function applyCouponCode(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            //find coupon from user apply code from cart page
            $coupon = Coupon::where('coupon_code', $data['code'])->where('status', 1)->first();
            //cart items gula nilam user er,, check er jnno je user kon kon category er prdct select krce
            $cartItems = Cart::getCartItems();
            //total select cartitems gula nilam
            $sumCartItems = sumCartItems();
            $message = "";
            if ($coupon) {
                //coupon kon category gula te kaj korbe sei category gula ber kore nilam coupon categoires thke
                $couponCats = explode(',', $coupon->categories);
                //coupon kon users gular jnno kaj korbe sei users gula ber kore nilam coupon users thke
                $couponUsers = explode(',', $coupon->users);
                //check coupon if expiry
                $expiry_date= $coupon->expiry_date;
                $current_date= date('Y-m-d');
                        //avabeo expiry date check kora jay isFuture() function ta check kore date expire ki na,, r aii isFuture functin ta use krte hole obossoy je model er db table er date colm ta use krbo sei clom er name ta oii model a protected $dates= ['clom_name'] dite hobe ex: Coupon model a
                    // if(!$expiry_date->isFuture()){
                    //     $message= 'Coupon Date is Expired';
                    // }
                //current date thke expiry date soto hole expire,, expiry date er theke jodi current date boro hoy thole expiry,, expire date er thke sob somoy current date soto thkbe tahole meyad ase
                if($expiry_date < $current_date){
                    $message= 'Coupon Date is Expired';
                }else{
                     //check user product cart a reke coupon code use krce naki cart empty reke
                    if(count($cartItems) < 1){
                        $message= 'Please Add Product in Cart, and apply this coupon';
                    }else{

                        foreach($cartItems as $cartItem){
                            if(!in_array($cartItem['product']['category_id'], $couponCats)){
                                $message= 'This Coupon not work on your current cart item products';
                            }
                        }

                            //step 1 for users ei coupn use krte pabe kina,, find coupon email by users id
                        foreach($couponUsers as $email){
                            $getUserId= User::select('id')->where('email',$email)->first()->toArray();
                            $userIds[]= $getUserId['id'];
                        }
                            //check user id and coupon er user id mil ase naki jodi mil thake tahole sei aii coupon er user
                        foreach($cartItems as $cartItem){
                            if(!in_array($cartItem['user_id'], $userIds)){
                                $message= 'You are not elegible user for this coupons';
                            }
                        }
                            //step 2 for users ei coupon use krte pabe kina,, oporer 2ta foreach diye ja kora ata 1ta foreach diye seta kora auth diye find kore
                        // $userEmail= Auth::user()->email;
                        // foreach($cartItems as $cartItem){
                        //     if(!in_array($userEmail, $couponUsers)){
                        //         $message= 'You are not elegible user for this coupon';
                        //     }
                        // }
                    }
                }

                //check user er selected product ta coupon code er category er naki onno categor er,, onno category mane je category te coupon deya nai
            } else {
                $message = 'Wrong Coupon Code, Please Enter Valid Coupon';
            }

            if($message == ""){
               $cartItems= Cart::getCartItems();
               $totalPrice= 0;
               $totalDiscount= 0;
               foreach($cartItems as $cartItem){
                    $productAttributePrice= Cart::getAttributePrice($cartItem['product_id'], $cartItem['size']);
                    $productDiscountPrice= Cart::getProductDiscoutedPriceByAttribute($cartItem['product_id'],$cartItem['size']);
                    $totalPrice= $totalPrice + ($productAttributePrice * $cartItem['quantity']);
                    $totalDiscount= $totalDiscount + ($productDiscountPrice * $cartItem['quantity']);
               }

               $grandTotalPrice= $totalPrice - $totalDiscount;
               if($coupon->amount_type == 'percentage'){
                    //$couponAmount= ($grandTotalPrice * $coupon->amount ) / 100;
                    $couponAmount= $coupon->amount;
                    $message= 'Successfully '.$coupon->amount.' % Coupon Discount Added';
               }else{
                    $couponAmount= $coupon->amount;
                    $message= 'Successfully '.$coupon->amount.' TK Coupon Discount Added';
               }

               Session::put('couponAmount',$couponAmount);
               Session::put('amount_type',$coupon->amount_type);
               Session::put('coupon_code',$coupon->coupon_code);


                return response()->json(['view' => (string)View::make('front.products.cart-items', [
                    'cartItems' => $cartItems,
                    'sumCartItems' => $sumCartItems,
                    'coupon' => $coupon,
                ]), 'message' => $message, 'status' => 'success']);
            }

            return response()->json(['view' => (string)View::make('front.products.cart-items', [
                'cartItems' => $cartItems,
                'sumCartItems' => $sumCartItems,
                'coupon' => $coupon,
            ]), 'message' => $message, 'status' => 'error']);
        }
    }
}
