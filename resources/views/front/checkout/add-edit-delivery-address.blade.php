@extends('master.front-master.master')

@section('title')
    {{ $title }}
@endsection

@section('body')
    <div class="span9">
        <ul class="breadcrumb">
            <li><a href="{{ route('front-home') }}">Home</a> <span class="divider">/</span></li>
            <li class="active">Login</li>
        </ul>
        <h3> DELIVERY ADDRESS</h3>
        <hr class="soft" />

        <div class="row">
            <div class="span4">
                @if (Session::has('message'))
                    <div class="alert alert-success" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                            <h4>{{ Session::get('message') }}</h4>
                    </div>
                @endif
                @if ($errors->any())
                    <div class="alert alert-danger" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                    </div>
                @endif
                <div class="well">
                    <h5>{{ $title }}</h5><br />
                    <form action="{{ !empty($deliveryData) ? route('front-add-edit-delivery-address', ['id' => $deliveryData->id]) : route('front-add-edit-delivery-address') }}" method="POST" id="deliveryAddressForm">
                        @csrf
                        <div class="control-group">
                            <label class="control-label" for="name">Name</label>
                            <div class="controls">
                                <input class="span3" type="text" id="name" name="name" placeholder="Name" value="{{ !empty($deliveryData) ? $deliveryData->name : old('name') }}">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="address">Address (House,road) or (Vill,Bazar)</label>
                            <div class="controls">
                                <input class="span3" type="text" id="address" name="address" placeholder="house,road number or vill,bazar name" value="{{ !empty($deliveryData) ? $deliveryData->address : old('address') }}">
                                {{-- <span id="emailExistsCheck"></span> ata ajx er jnno --}}
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="city">City</label>
                            <div class="controls">
                                <input class="span3" type="text" name="city" id="city" placeholder="enter City" value="{{ !empty($deliveryData) ? $deliveryData->city : old('city') }}">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="district">District</label>
                            <div class="controls">
                                <input class="span3" type="text" name="district" id="district" placeholder="district" value="{{ !empty($deliveryData) ? $deliveryData->district : old('district') }}">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="division">Division</label>
                            <div class="controls">
                                <input class="span3" type="text"  id="division" name="division" placeholder="division" value="{{ !empty($deliveryData) ? $deliveryData->division : old('division') }}">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="pincode">Pincode</label>
                            <div class="controls">
                                <input class="span3" type="text"  id="pincode" name="pincode" placeholder="pincode" value="{{ !empty($deliveryData) ? $deliveryData->pincode : old('pincode') }}">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="pincode">Mobile Number</label>
                            <div class="controls">
                                <input class="span3" type="text"  id="phone" name="phone" placeholder="phone" value="{{ !empty($deliveryData) ? $deliveryData->phone : old('phone') }}">
                            </div>
                        </div>
                        <div class="controls">
                            @if (!empty($deliveryData))
                                <button type="submit" class="btn block">Update Delivery Address</button>
                             @else
                                <button type="submit" class="btn block">Create Delivery Address</button>
                            @endif
                            <a class="btn btn-info pull-right" href="{{ route('front-checkout') }}">Back</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('front-js')
    <script>
        $(document).ready(function(){
            		// validate signup form on keyup and submit
		$("#deliveryAddressForm").validate({
			rules: {
				name: "required",
				address: {
					required: true,
                	minlength:3
				},
				city: {
					required: true,
				},
				district: {
					required: true,
				},
				division: {
					required: true,
				},
				pincode: {
					digits: true,
				},
				phone: {
					required: true,
					minlength: 11,
					maxlength: 11,
                    digits: true
				},

			},
			messages: {
				name: "Please enter your firstname",
			}
		});

        });
    </script>

@endsection
