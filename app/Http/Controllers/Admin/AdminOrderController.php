<?php

namespace App\Http\Controllers\Admin;

use App\Coupon;
use App\District;
use App\Division;
use App\Http\Controllers\Controller;
use App\Order;
use App\OrderLog;
use App\OrderStatus;
use App\Union;
use App\Upazila;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class AdminOrderController extends Controller
{
    public function orders()
    {
        //to array kore aii kaj korlam tai relation a with diye relattion fnctin er name dilam
        $orders = Order::with('orders_products', 'user_info')->orderBy('id', 'DESC')->get()->toArray();
        // dd($orders); die;
        return view('admin.orders.orders', ['orders' => $orders]);
    }

    public function orderDetails($order_id)
    {

        $ordersDetails = Order::where('id', $order_id)->firstOrFail(); //firstOrFail ata hosse data asle akta row return krbe r na asle 404 page return korbe
        //ata amar mastani kore ber kora avabe aii coupon code er option ta
        $coupon = Coupon::select('amount_type')->where('coupon_code', $ordersDetails->coupon_code)->first();
        $userDetails = User::where('id', $ordersDetails->user_id)->first();

        //user table a address a vul kore id gula rakci tai id diye user er address nilam
        $division = Division::find($userDetails->division);
        $district = District::find($userDetails->district);
        $upazila = Upazila::find($userDetails->upazila);
        $union = Union::find($userDetails->unions);

        $orderStatuses = OrderStatus::where('status', 1)->get();
        $orderLogs = OrderLog::where('order_id', $order_id)->orderBy('id','DESC')->get();
        return view('admin.orders.order_details', [
            'ordersDetails' => $ordersDetails,
            'orderStatuses' => $orderStatuses,
            'coupon' => $coupon,
            'userDetails' => $userDetails,
            'division' => $division,
            'district' => $district,
            'upazila' => $upazila,
            'union' => $union,
            'orderLogs' => $orderLogs
        ]);
    }

    public function updateOrderStatus(Request $request, $order_id)
    {
        $data = $request->all();

        //validate courier name and tracking number field when stauts will be shipped
        if ($data['order_status'] == 'Shipped') {
            $this->validate($request, [
                'courier_name' => 'required|alpha',
                'tracking_number' => 'required|numeric'
            ]);
        }

        $ordersDetails = Order::with('orders_products', 'user_info')->where('id', $order_id)->first()->toArray(); //aii order a delivey adderess and order info ase
        //return $ordersDetails;
            date_default_timezone_set('Asia/Dhaka');
        //update order status from admin order details page
        Order::where('id', $order_id)->update(['order_status' => $data['order_status']]);

        //if oder statas updated to shipped then update orders table
        if (!empty($data['courier_name'] && !empty($data['tracking_number']))) {
            Order::where('id', $order_id)->update(['courier_name' => $data['courier_name'], 'tracking_number' => $data['tracking_number']]);
        }

        //now iam send mail to delivey address email

        $coupon = Coupon::where('coupon_code', $ordersDetails['coupon_code'])->first();

        if ($coupon) {
            $couponAmountType = $coupon->amount_type;
        } else {
            $couponAmountType = '';
        }

        $email = $ordersDetails['email'];
        //akhane order cusmtomer name ta amr ponditi kore deya, akhane sudu name = orderDetails['name'] ata nilei hoito
        $messageData = [
            'order_customer_name' => $ordersDetails['user_info']['name'],
            'delivery_customer_name' => $ordersDetails['name'],
            'order_id' => $order_id,
            'order_status' => $data['order_status'],
            'orderDetails' => $ordersDetails,
            'amount_type' => $couponAmountType,
            'courier_name' => $data['courier_name'],
            'tracking_number' => $data['tracking_number'],
        ];
            //send order status mail to user, when update the product status in admin panel
        Mail::send('mail.order-status-mail',$messageData, function( $message) use ($email){
            $message->to($email)->subject('Order Status -Ecom');
        });

        //keep order status update histoty log into OrderLogs table,, every update status will stay in this table
        $orderLog = new OrderLog();
        $orderLog->order_id = $order_id;
        $orderLog->order_status = $data['order_status'];
        $orderLog->save();

        return redirect()->back()->with('message', 'Oreder Status Update Successfully');
    }
}
