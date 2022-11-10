<?php

namespace App\Http\Controllers\Admin;

use App\Coupon;
use App\Http\Controllers\Controller;
use App\Order;
use Illuminate\Http\Request;

class AdminOrderController extends Controller
{
    public function orders()
    {
        //to array kore aii kaj korlam tai relation a with diye relattion fnctin er name dilam
        $orders = Order::with('orders_products')->orderBy('id', 'DESC')->get()->toArray();
        // dd($orders); die;
        return view('admin.orders.orders', ['orders' => $orders]);
    }

    public function orderDetails($order_id)
    {

        $ordersDetails = Order::where('id', $order_id)->firstOrFail(); //firstOrFail ata hosse data asle akta row return krbe r na asle 404 page return korbe
        //ata amar mastani kore ber kora avabe aii coupon code er option ta
        $coupon = Coupon::select('amount_type')->where('coupon_code', $ordersDetails->coupon_code)->first();
        return view('admin.orders.order_details', ['ordersDetails' => $ordersDetails, 'coupon' => $coupon]);
    }
}
