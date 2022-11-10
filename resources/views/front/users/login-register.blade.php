@extends('master.front-master.master')

@section('title')
    Login | Register
@endsection

@section('body')
    <div class="span9">
        <ul class="breadcrumb">
            <li><a href="{{ route('front-home') }}">Home</a> <span class="divider">/</span></li>
            <li class="active">Login</li>
        </ul>
        <h3> Login</h3>
        <hr class="soft" />

        <div class="row">
            <div class="span4">
                @if (Session::has('error_message'))
                    <div class="alert alert-danger" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                            <h4>{{ Session::get('error_message') }}</h4>
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
                <div class="well">
                    <h5>CREATE YOUR ACCOUNT</h5><br />
                    Enter your e-mail address to create an account.<br /><br /><br />
                    <form action="{{ route('front-user-register') }}" method="POST" id="userSignupForm">
                        @csrf
                        <div class="control-group">
                            <label class="control-label" for="name">Name</label>
                            <div class="controls">
                                <input class="span3" type="text" id="name" name="name" placeholder="Name">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="email">E-mail address</label>
                            <div class="controls">
                                <input class="span3" type="email" id="email" name="email" placeholder="Email">
                                {{-- <span id="emailExistsCheck"></span> ata ajx er jnno --}}
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="mobile">Mobile</label>
                            <div class="controls">
                                <input class="span3" type="number" name="mobile" id="mobile" placeholder="Mobile">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="password">Password</label>
                            <div class="controls">
                                <input class="span3" type="password" name="password" id="password" placeholder="Password">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="password">Password</label>
                            <div class="controls">
                                <input class="span3" type="password"  id="confirm_password" name="confirm_password" placeholder="Confirm Password">
                            </div>
                        </div>
                        <div class="controls">
                            <button type="submit" class="btn block">Create Your Account</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="span1"> &nbsp;</div>
            <div class="span4">
                @if (Session::has('error_login'))
                    <div class="alert alert-danger" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                            <h4>{{ Session::get('error_login') }}</h4>
                    </div>
                @endif
                <div class="well">
                    <h5>ALREADY REGISTERED ?</h5>
                    <form action="{{ route('front-user-login') }}" method="POST" id="userLoginForm">
                        @csrf
                        <div class="control-group">
                            <label class="control-label" for="loginEmail">Email</label>
                            <div class="controls">
                                <input class="span3" type="text" name="loginEmail" id="loginEmail" placeholder="Email">
                                <br/>
                                <span style="color: red;">
                                    @error('loginEmail')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="loginPassword">Password</label>
                            <div class="controls">
                                <input type="password" class="span3" name="loginPassword" id="loginPassword" placeholder="Password">
                                <br/>
                                <span style="color: red;">
                                    @error('loginPassword')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                        </div>
                        <div class="control-group">
                            <div class="controls">
                                <button type="submit" class="btn">Sign in</button> <a href="forgetpass.html">Forget
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
    {{-- for ajax method --}}
    {{-- <script>
        $(document).ready(function(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $(document).on('keyup', '#emailCheck', function(){
                var email = $(this).val();
                $.ajax({
                    type: 'post',
                    url: "{{ route('front-signup-email-check') }}",
                    data: {email:email},
                    success: function(resp){
                        if(resp.email == 'exists'){
                            $('#emailExistsCheck').html('<font style="color:red;display:block;">Email Already Exists.!</font>');
                        }
                    }
                })
            });
        });
    </script> --}}
    <script>
        $(document).ready(function(){
            		// validate signup form on keyup and submit
		$("#userSignupForm").validate({
			rules: {
				name: "required",
				email: {
					required: true,
					email: true,
                    remote: "{{ route('front-signup-email-check')}}",
				},
				mobile: {
					required: true,
					minlength: 11,
					maxlength: 11,
                    digits: true
				},
				password: {
					required: true,
					minlength: 6
				},
				confirm_password: {
					required: true,
					minlength: 6,
					equalTo: "#password"
				}
			},
			messages: {
				name: "Please enter your firstname",
				password: {
					required: "Please provide a password",
					minlength: "Your password must be at least 5 characters long"
				},
				confirm_password: {
					required: "Please provide a password",
					minlength: "Your password must be at least 6 characters long",
					equalTo: "Please enter the same password as above"
				},
				email: {
                    required: "Please enter email",
                    email: "Please enter a valid email address",
                    remote: "This Email Already Exists",
                },
			}
		});

		$("#userLoginForm").validate({
			rules: {
				loginEmail: {
					required: true,
					email: true,
				},
				loginPassword: {
					required: true,
					minlength: 6
				},
			},
			messages: {
				loginPassword: {
					required: "Please provide a password",
					minlength: "Your password must be at least 6 characters long"
				},
				loginEmail: {
                    required: "Please enter email",
                    email: "Please enter a valid email address",
                },
			}
		});

        });
    </script>

@endsection
