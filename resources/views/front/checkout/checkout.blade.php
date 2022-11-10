<?php use App\Cart; ?>
@extends('master.front-master.master')
@section('title')
    Checkout
@endsection

@section('body')
    <div class="span9">
        <ul class="breadcrumb">
            <li><a href="{{ route('front-home') }}">Home</a> <span class="divider">/</span></li>
            <li class="active"> CHECKOUT PAGE</li>
        </ul>
        <h3> CHECKOUT [ <small><span class="sumCartItem">{{ sumCartItems() }}</span> Item(s) </small>]<a
                href="{{ route('front-cart-page') }}" class="btn btn-large pull-right"><i class="icon-arrow-left"></i> Back to Cart</a>
        </h3>
        <hr class="soft" />
        @if (Session::has('error_message'))
            <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
                <h4>{{ Session::get('error_message') }}</h4>
              </div>
            @endif
        <form action="{{ route('front-place-order') }}" method="POST">
            @csrf
        <table class="table">
            <tr>
                <th style="font-size: 18px;">Delivery Address </th>
                <th style="text-align: right"><a class="btn btn-sm btn-primary" href="{{ route('front-add-edit-delivery-address') }}">Add Address</a></th>
            </tr>
         @if (count($deliveryAddresses) > 0)
         @foreach ($deliveryAddresses as $address)
         <tr id="deleteAddress-{{ $address->id }}">
          <td>
              <div class="control-group">
                  <div class="controls">
                  <label for="address-{{ $address->id }}">
                      <input id="address-{{ $address->id }}" style="margin-top: -3px;" type="radio" name="address_id" value="{{ $address->id }}">
                     Address: {{ $address->name }}, {{ $address->address }}, {{ $address->city }}, {{ $address->district }}, {{ $address->division }} (Mobile: {{ $address->phone }})
                  </label>
                  </div>
              </div>
          </td>
          <td style="text-align: right">
              <div class="control-group">
                  <div class="controls">
                      <a href="{{ route('front-add-edit-delivery-address', ['id' => $address->id]) }}" class="btn btn-info">Edit</a>
                      <a href="javascript:void(0);" class="confirmDelete btn btn-danger" record="delivery-address" recordId="{{ $address->id }}">Delete</a>
                  </div>
              </div>
          </td>
      </tr>
         @endforeach
        @else
        <tr>
            <th style="font-size: 18px; text-align:center">Delivery Address Empty, Please Add Delivery Address</th>
            <th></th>
        </tr>
         @endif
        </table>

        <hr>
            <p style="font-size: 18px; text-align:center; font-weight:bold;">---- Check Cart Items ----</p>
        <hr>
        <div id="appendCartItems">
            @include('front.products.cart-items')
        </div>


        <table class="table table-bordered">
            <tbody>
                <tr>
                    <td>
                        <div class="control-group" style="text-align: center">
                                <p style="font-size: 18px; text-align:center; font-weight:bold;">---- Payment Methods ----</p>
                                <div class="controls" style="font-size: 15px;">
                                    <label style="border: 2px solid black; display:inline-block; padding: 5px;" for="cod"><input id="cod" style="margin-top: -3px; margin-left:5px;" type="radio" name="payment" value="Cod"  class="input-medium"> Cash On Delivery</label>
                                    <label style="border: 2px solid black; display:inline-block; padding: 5px;"><input style="margin-top: -3px; margin-left:5px;" type="radio" name="payment" value="Bkash"  class="input-medium"> Bkash</label>
                                    <label style="border: 2px solid black; display:inline-block; padding: 5px;"><input style="margin-top: -3px; margin-left:5px;" type="radio" name="payment" value="Rocket"  class="input-medium"> Rocket</label>
                                    <label style="border: 2px solid black; display:inline-block; padding: 5px;"><input style="margin-top: -3px; margin-left:5px;" type="radio" name="payment" value="Nagat"  class="input-medium"> Nagat</label>
                                    <label style="border: 2px solid black; display:inline-block; padding: 5px;"><input style="margin-top: -3px; margin-left:5px;" type="radio" name="payment" value="Paypal"  class="input-medium"> Paypal</label>
                                </div>
                        </div>
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
        <a href="{{ route('front-cart-page') }}" class="btn btn-large"><i class="icon-arrow-left"></i> Back to Cart </a>
        <button type="submit" class="btn btn-large pull-right">Place Order <i class="icon-arrow-right"></i></button>
    </form>
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
    </script>
     <script>
        $(".confirmDelete").click(function(){
           var recordId= $(this).attr("recordId");
           Swal.fire({
           title: 'Are you sure?',
           text: "You won't be able to revert this!",
           icon: 'warning',
           showCancelButton: true,
           confirmButtonColor: '#3085d6',
           cancelButtonColor: '#d33',
           confirmButtonText: 'Yes, delete it!'
           }).then((result) => {
           if (result.isConfirmed) {

                $.ajax({
                    type: 'post',
                    url: "{{ route('front-delete-delivery-address') }}",
                    data: {recordId:recordId},
                    success: function(resp){
                        if(resp.status == 1){
                            $("#deleteAddress-"+recordId).empty();
                        }
                    }
                })
               return false;
               Swal.fire(
               'Deleted!',
               'Your file has been deleted.',
               'success',
               )

                   //url diye delete krte chaile avabe
              // window.location.href="{{ url('/') }}/admin/delete-"+record+"/"+recordId;

           //    form diye delete krte chile
           //    $('#confirmDeleteForm').submit();

           }
           })
       });
     </script>
@endsection
