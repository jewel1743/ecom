<?php use App\Cart; ?>
@extends('master.front-master.master')
@section('title')
    Cart
@endsection

@section('body')
    <div class="span9">
        <ul class="breadcrumb">
            <li><a href="{{ route('front-home') }}">Home</a> <span class="divider">/</span></li>
            <li class="active"> SHOPPING CART</li>
        </ul>
        <h3> SHOPPING CART [ <small><span class="sumCartItem">{{ sumCartItems() }}</span> Item(s) </small>]<a
                href="{{ route('front-home') }}" class="btn btn-large pull-right"><i class="icon-arrow-left"></i> Continue Shopping </a>
        </h3>
        <hr class="soft" />
        @if (!Auth::check())
            @if (Session::has('error_login'))
                <div class="alert alert-danger" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4>{{ Session::get('error_login') }}</h4>
                </div>
            @endif
            <table class="table table-bordered">
                <tr>
                    <th> I AM ALREADY REGISTERED </th>
                </tr>
                <tr>
                    <td>
                        <form class="form-horizontal" action="{{ route('front-user-login') }}" method="POST">
                            @csrf
                            <div class="control-group">
                                <label class="control-label" for="inputUsername">Email</label>
                                <div class="controls">
                                    <input type="email" name="loginEmail" id="inputUsername" placeholder="Username">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="inputPassword1">Password</label>
                                <div class="controls">
                                    <input type="password" name="loginPassword" id="inputPassword1" placeholder="Password">
                                </div>
                            </div>
                            <div class="control-group">
                                <div class="controls">
                                    <button type="submit" class="btn">Sign in</button> OR <a
                                        href="{{ route('front-login-register') }}" class="btn">Register Now!</a>
                                </div>
                            </div>
                            <div class="control-group">
                                <div class="controls">
                                    <a href="{{ route('front-user-forgot-password') }}"
                                        style="text-decoration:underline">Forgot password ?</a>
                                </div>
                            </div>
                        </form>
                    </td>
                </tr>
            </table>
        @endif
        @if (Session::has('message'))
        <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            <h4>{{ Session::get('message') }}</h4>
          </div>
        @endif
        <div id="appendCartItems">
            @include('front.products.cart-items')
        </div>


        <table class="table table-bordered">
            <tbody>
                <tr>
                    <td>
                        <form id="couponCodeForm" class="form-horizontal" @if(Auth::check()) user="1" @endif action="javascript:void(0)">
                            <div class="control-group">
                                <label class="control-label"><strong> COUPON CODE: </strong> </label>
                                <div class="controls">
                                    <input type="text" name="code" id="code" class="input-medium" placeholder="Enter Coupon Code">
                                    <button type="submit" class="btn"> APPLY </button>
                                    <br/><span style="display: inline-block; margin-top: 10px;" id="couponMsg"></span>
                                </div>
                            </div>
                        </form>
                    </td>
                </tr>

            </tbody>
        </table>

        <!-- <table class="table table-bordered">
           <tr><th>ESTIMATE YOUR SHIPPING </th></tr>
           <tr>
           <td>
            <form class="form-horizontal">
            <div class="control-group">
             <label class="control-label" for="inputCountry">Country </label>
             <div class="controls">
             <input type="text" id="inputCountry" placeholder="Country">
             </div>
            </div>
            <div class="control-group">
             <label class="control-label" for="inputPost">Post Code/ Zipcode </label>
             <div class="controls">
             <input type="text" id="inputPost" placeholder="Postcode">
             </div>
            </div>
            <div class="control-group">
             <div class="controls">
             <button type="submit" class="btn">ESTIMATE </button>
             </div>
            </div>
            </form>
           </td>
           </tr>
                    </table> -->
        <a href="{{ route('front-home') }}" class="btn btn-large"><i class="icon-arrow-left"></i> Continue Shopping </a>
        <a href="{{ route('front-checkout') }}" class="btn btn-large pull-right">Next <i class="icon-arrow-right"></i></a>

    </div>
@endsection

@section('front-js')
    <script>
        //ajax post request csrt setup
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        //cart item quantity update
        $(document).ready(function() {
            $(document).on('click', '.qtyUpdateBtn', function() {
                if ($(this).hasClass('qtyMinus')) {
                    var cartId = $(this).data("cartid");
                    var quantity = $(this).prev()
                .val(); //2ta alada alada vabe kora hoye prev() diye ata mane jekhane click krbo setar ager element er value nilam prev() diye ata sei ex: diye kora ase r pore if ta id="cart-" id diye kora ase 2tay valo
                    if (quantity <= 1) {
                        alert('Minimum at least 1 quantity is requred.!');
                        return false;
                    } else {
                        new_quantity = parseInt(quantity) - 1;
                    }
                }
                if ($(this).hasClass('qtyPlus')) {
                    var cartId = $(this).data("cartid");
                    var quantity = $('#cart-' + cartId).val();
                    //var quantity = $(this).prev().prev().val(); //prev() mane hosse aii clss jekhane ase mane jekhane click hosse tar ager element er value ta nibe akhane 2bar prev() use krci karon ata + btn r + btn ta value er 2ta element por ase tai
                    var stock = $(this).data("stock");
                    if (quantity >= stock) {
                        alert('Your Requred More Quantity is Not Availabe, This Product Size Availabe Stock is ' +
                            stock);
                        return false;
                    } else {
                        new_quantity = parseInt(quantity) + 1;
                    }
                }

                $.ajax({
                    type: 'post',
                    url: "{{ route('front-update-cart') }}",
                    data: {
                        cartId: cartId,
                        new_quantity: new_quantity
                    },
                    success: function(resp) {
                        $('#appendCartItems').html(resp.view);
                        $('.sumCartItem').html(resp.sumCartItems);
                    },

                });
            });
            //delete cartItems
            $(document).on('click', '#deleteItem', function() {
                var cart_id = $(this).attr("cart_id");
                //confirm alert ta ok krle true return kre r cancel a click krle false retun kre jodi true hoy tahle if er vitor dhukbe and delete hove
                var result = confirm("Do you Want to remove this Item from cart?");
                if (result) {
                    $.ajax({
                        type: 'post',
                        url: "{{ route('front-delete-cart-item') }}",
                        data: {
                            cart_id: cart_id
                        },
                        success: function(resp) {
                            $('#appendCartItems').html(resp.view);
                            $('.sumCartItem').html(resp.sumCartItems);
                        }
                    });
                }
            })
        });

            //coupon code functionality
                //submit() on click er moto ,, submit hole aii fuctn kj krbe
            $("#couponCodeForm").submit(function(){
                var code= $("#code").val();
                var user= $(this).attr("user");

                //check user login or not
                if(user != 1){
                    $("#couponMsg").html('<font color="red">Please Login First</forn>');
                    return false; //return false dilam karon user login na thkle jeno nicher ajax code gula na run hoy aii else block thke ber hoy, tai akahn thke retunn krlm false
                }

                $.ajax({
                    type: 'post',
                    url: "{{ route('front-apply-coupon-code') }}",
                    data: {code:code},
                    success: function(resp){
                        $('#appendCartItems').html(resp.view);
                        if(resp.status == 'error'){
                            $("#couponMsg").html('<font color="red">'+resp.message+'</font>');
                        }
                        else if(resp.status == 'success'){
                            $("#couponMsg").html('<font color="green">'+resp.message+'</font>');
                        }

                    }
                })
            });
    </script>
@endsection
