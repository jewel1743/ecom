<?php use App\Cart; ?>
@extends('master.front-master.master')
@section('title')
    Checkout
@endsection

@section('body')
    <div class="span9">
        <ul class="breadcrumb">
            <li><a href="{{ route('front-home') }}">Home</a> <span class="divider">/</span></li>
            <li class="active">Orders</li>
        </ul>
        <h4 style="margin: 10px;">Orders</h4>
        <table class="table table-bordered">
            <tr>
                <th>Order ID</th>
                <th>Product Code</th>
                <th>Product Name</th>
                <th>Payment Method</th>
                <th>Grand Total</th>
                <th>Order Date</th>
                <th>Order Details</th>
            </tr>
            @foreach ($orders as $order)
            <tr>
                <td>{{ $order['id'] }}</td>
                <td>
                    @foreach ($order['orders_products'] as $product)
                        {{ $product['product_code'] }} <br>
                    @endforeach
                </td>
                <td>
                    @foreach ($order['orders_products'] as $product)
                        {{ $product['product_name'] }} <br>
                    @endforeach
                </td>
                <td>{{ $order['payment_method'] }}</td>

                <td>{{ $order['grand_total'] }} TK</td>
                <td>{{ date('d-m-Y',strtotime($order['created_at'] ))}}</td>
                <td><a href="{{ route('front-order-details',['order_id' => $order['id']]) }}">Order Details</a></td>
            </tr>
            @endforeach
        </table>
    </div>
@endsection

