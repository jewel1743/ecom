<?php use App\Cart; ?>
@extends('master.front-master.master')
@section('title')
    Checkout
@endsection

@section('body')
    <div class="span8">
        <ul class="breadcrumb">
            <li><a href="{{ route('front-home') }}">Home</a> <span class="divider">/</span></li>
            <li><a href="{{ route('front-orders') }}">Orders</a></li>
        </ul>
        <h4 class="well"><strong> Order #{{ $ordersDetails->id }} Details</strong></h4>
    </div>
    <div class="span4">
        <table class="table table-bordered">
            <tr>
                <th colspan="2"><strong> Order Details</strong></th>
            </tr>
            <tr>
                <td>Order Date</td>
                <td>{{ $ordersDetails->created_at->format('d-M-Y') }}</td>
            </tr>
            <tr>
                <td>Order Status</td>
                <td>{{ $ordersDetails->order_status }}</td>
            </tr>
            <tr>
                <td>Order Total</td>
                <td>TK. {{ $ordersDetails->grand_total }}</td>
            </tr>
            <tr>
                <td>Shipping Charge</td>
                <td>{{ $ordersDetails->shipping_charge}}</td>
            </tr>
            <tr>
                <td>Coupon Code</td>
                <td>{{ $ordersDetails->coupon_code }}</td>
            </tr>
            <tr>
                <td>Coupon Amount</td>
                <td>
                    @if (!empty($coupon))
                        @if ($coupon->amount_type == 'percentage')
                        {{ $ordersDetails->coupon_amount }} %
                        @else
                            TK. {{ $ordersDetails->coupon_amount }}
                        @endif
                    @else
                        {{ $ordersDetails->coupon_amount }}
                    @endif
                </td>
            </tr>
            <tr>
                <td>Payment Method</td>
                <td>{{ $ordersDetails->payment_method }}</td>
            </tr>
        </table>
    </div>
    <div class="span4">
        <table class="table table-bordered">
            <tr>
                <th colspan="2"><strong> Delivery Address</strong></th>

            </tr>
            <tr>
                <td>Name</td>
                <td>{{ $ordersDetails->name }}</td>
            </tr>
            <tr>
                <td>Address</td>
                <td>{{ $ordersDetails->address }}</td>
            </tr>
            <tr>
                <td>City</td>
                <td>{{ $ordersDetails->city }}</td>
            </tr>
            <tr>
                <td>District</td>
                <td>{{ $ordersDetails->district}}</td>
            </tr>
            <tr>
                <td>Division</td>
                <td>{{ $ordersDetails->division }}</td>
            </tr>
            <tr>
                <td>Pincode</td>
                <td>
                    {{ $ordersDetails->pincode }}
                </td>
            </tr>
            <tr>
                <td>Mobile</td>
                <td>{{ $ordersDetails->mobile }}</td>
            </tr>
        </table>
    </div>
    <div class="span8">
        <table class="table table-bordered">
            <tr>
                <th colspan="7"><strong>Order Products Details</strong></th>
            </tr>
            <tr>
                <th>Image</th>
                <th>Name</th>
                <th>Code</th>
                <th>Size</th>
                <th>Color</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>View</th>
            </tr>
            @foreach ($ordersDetails->orders_products as $orderProduct)
            <tr>
                <td><img src="{{ asset('images/product-image/small/'.$orderProduct->product->main_image) }}" alt="{{ $orderProduct->product->main_image }}" height="80" width="80"></td>
                <td>{{ $orderProduct->product_name }}</td>
                <td>{{ $orderProduct->product_code }}</td>
                <td>{{ $orderProduct->product_size}}</td>
                <td>{{ $orderProduct->product_color }}</td>
                <td>{{ $orderProduct->product_price }}</td>
                <td>{{ $orderProduct->product_quantity }}</td>
                <td><a target="_blank" href="{{ route('front-product-details',['id' => $orderProduct->product_id]) }}">View</a></td>
            </tr>
            @endforeach
        </table>
    </div>
@endsection

