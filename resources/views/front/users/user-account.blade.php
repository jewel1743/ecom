@extends('master.front-master.master')

@section('title')
    My Account
@endsection

@section('body')
    <div class="span9">
        <ul class="breadcrumb">
            <li><a href="{{ route('front-home') }}">Home</a> <span class="divider">/</span></li>
            <li class="active">My Account</li>
        </ul>
        <h3> My Account</h3>
        <hr class="soft" />
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
        @if (Session::has('success_message'))
            <div class="alert alert-success" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4>{{ Session::get('success_message') }}</h4>
            </div>
        @endif
        @if (Session::has('error_message'))
            <div class="alert alert-danger" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4>{{ Session::get('error_message') }}</h4>
            </div>
        @endif
        <div class="row">
            <div class="span4">
                <div class="well">
                    <h5>UPDATE YOUR ACCOUNT INFO</h5><br />
                    Enter your e-mail address to create an account.<br /><br /><br />
                    <form action="{{ route('front-update-user-info', ['id' => $userInfo['id']]) }}" method="POST"
                        id="userUpdateForm">
                        @csrf
                        <div class="control-group">
                            <label class="control-label">E-mail address</label>
                            <div class="controls">
                                <input class="span3" type="text" value="{{ $userInfo->email }}" readonly>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="name">Name</label>
                            <div class="controls">
                                <input class="span3" name="name" type="text" value="{{ $userInfo->name }}"
                                    id="name" placeholder="Name">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="mobile">Mobile</label>
                            <div class="controls">
                                <input class="span3" name="mobile" type="text" value="{{ $userInfo->mobile }}"
                                    id="mobile" placeholder="Mobile">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="pincode">Pincode</label>
                            <div class="controls">
                                <input class="span3" name="pincode" type="text" value="{{ $userInfo->pincode }}"
                                    id="pincode" placeholder="Pincode">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="inputEmail0">Division</label>
                            <div class="controls">
                                <select name="division" id="division">
                                    <option value="" disabled selected>Select Division</option>
                                    @foreach ($divisions as $division)
                                        <option value="{{ $division['id'] }}" {{ isset($userInfo->division)  && $userInfo->division == $division['id'] ? 'selected' : '' }}>{{ $division['name'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="inputEmail0">District</label>
                            <div class="controls appendDistrict">
                                @include('front.users.append-districts')
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Upazila</label>
                            <div class="controls appendUpazila">
                                @include('front.users.append-upazila')
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Union</label>
                            <div class="controls appendUnion">
                                @include('front.users.append-union')
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="address">Address</label>
                            <div class="controls">
                                <input class="span3" name="address" value="{{ $userInfo['address'] }}" type="text"
                                    id="address" placeholder="address">
                            </div>
                        </div>
                        <div class="controls">
                            <button type="submit" class="btn block">Update Your Account</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="span1"> &nbsp;</div>
            <div class="span4">
                <div class="well">
                    <h5 style="margin-bottom: 10px;">Change Password</h5>
                    <form action="{{ route('front-user-update-password', ['id' => $userInfo->id]) }}" method="POST" id="changePasswordForm">
                        @csrf
                        <div class="control-group">
                            <label class="control-label" for="currentPassword">Current Password</label>
                            <div class="controls">
                                <input class="span3" type="text" name="currentPassword" id="currentPassword" placeholder="Enter Current Password">
                                <span id="passwordCheckMessage"></span>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="newPassword">New Password</label>
                            <div class="controls">
                                <input type="password" class="span3" name="newPassword" id="newPassword" placeholder="New Password">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="confirmPassword">Confirm Password</label>
                            <div class="controls">
                                <input type="password" class="span3" name="confirmPassword" id="confirmPassword" placeholder="Confirm Password">
                            </div>
                        </div>
                        <div class="control-group">
                            <div class="controls">
                                <button type="submit" class="btn">Upade Password</button> <a href="{{ route('front-user-forgot-password') }}">Forget
                                    password?</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('front-js')
    <script>
            //for ajax post request setup
        $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

        $(document).ready(function() {

            $(document).on("change", "#division", function() {
                var division_id = $(this).val();
                $.ajax({
                    type: 'post',
                    url: "{{ route('front-get-district') }}",
                    data: {
                        division_id: division_id
                    },
                    success: function(resp) {
                        $('.appendDistrict').html(resp);
                    }
                })

            });

            $(document).on("change", "#district", function() {
                var district_id = $(this).val();
                $.ajax({
                    type: 'post',
                    url: "{{ route('front-get-upazila') }}",
                    data: {
                        district_id: district_id
                    },
                    success: function(resp) {
                        $('.appendUpazila').html(resp);
                    }
                })

            });

            $(document).on("change", "#upazila", function() {
                var upazilla_id = $(this).val();
                $.ajax({
                    type: 'post',
                    url: "{{ route('front-get-union') }}",
                    data: {
                        upazilla_id: upazilla_id
                    },
                    success: function(resp) {
                        $('.appendUnion').html(resp);
                    }
                })

            });



            //jqurey validation for user update
            $("#userUpdateForm").validate({
                rules: {
                    name: "required",
                    mobile: {
                        required: true,
                        minlength: 11,
                        maxlength: 11,
                        digits: true
                    },
                    division: "required",
                    district: "required",
                    upazila: "required",
                    union: "required"
                },
                messages: {
                    name: "Please enter your Name",
                    mobile: {
                        required: "Please enter Mobile",
                    },
                }
            });

            //jqurey validation for user update password
            $("#changePasswordForm").validate({
                rules: {
                    currentPassword: {
                        required: true,
                        remote: {
                            url: "{{ route('front-check-current-password') }}",
                            type: 'post',
                            data: {
                                currentPassword: function(){
                                    return $('#currentPassword').val();
                                }
                            }
                        }
                    },
                    newPassword: {
                        required: true,
                        minlength: 6,
                    },
                    confirmPassword: {
                        required: true,
                        equalTo: "#newPassword",
                    }
                },
                messages: {
                    currentPassword: {
                        required: "Current password is required",
                        remote: "Current password is incorrect",
                    },
                    newPassword: {
                        required: "New Password is requred",
                        minlength: "Password must be 6 length",
                    },
                    confirmPassword: {
                        required: "Confirm password is requred",
                        equalTo: "Confirm password dosen't match with new password",
                    },
                }
            });

        });
    </script>
@endsection
