<?php use App\Cart; ?>
@extends('master.front-master.master')
@section('title')
    Thanks
@endsection

@section('body')
    <div class="span9">
        <ul class="breadcrumb">
            <li><a href="{{ route('front-home') }}">Home</a> <span class="divider">/</span></li>
            <li class="active"> THANKS</li>
        </ul>
        <hr class="soft" />
        <div style="text-align: center; margin-top: 30px;">
            <h4 style="color:green;">THANKS.!! Your Order has been placed successfully</h4>
            <p>Your Order Number Is : <strong>{{ Session::get('order_id') }}</strong>, Grand Total is : <strong>{{ Session::get('grand_total') }} TK.</strong></p>
        </div>
    </div>
    <?php
        Session::forget('order_id');
        Session::forget('grand_total');
     ?>
@endsection
