@extends('master.front-master.master')
@section('title')
    Forgot Password
@endsection

@section('body')
<div class="span9">
    <ul class="breadcrumb">
		<li><a href="{{ route('front-home') }}">Home</a> <span class="divider">/</span></li>
		<li class="active">Forget password?</li>
    </ul>
	<h3> FORGET YOUR PASSWORD?</h3>
	<hr class="soft"/>

	<div class="row">
		<div class="span9" style="min-height:900px">
            @if (Session::has('error_message'))
                    <div class="alert alert-danger" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                            <h6>{{ Session::get('error_message') }}</h6>
                    </div>
                @endif
                @if (Session::has('success_message'))
                    <div class="alert alert-success" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                            <h6>{{ Session::get('success_message') }}</h6>
                    </div>
                @endif
			<div class="well">
			<h5>Reset your password</h5><br/>
			    Please enter the email address for your account. A verification code will be sent to you. Once you have received the verification code, you will be able to choose a new password for your account.<br/><br/><br/>
			<form action="{{ route('front-user-forgot-password') }}" method="POST">
                @csrf
			  <div class="control-group">
				<label class="control-label" for="inputEmail1">E-mail address</label>
				<div class="controls">
				  <input class="span3"  type="email" name="email" id="inputEmail1" placeholder="Email">
				</div>
			  </div>
			  <div class="controls">
			  <button type="submit" class="btn block">Submit</button>
			  </div>
			</form>
		</div>
		</div>
	</div>

</div>
@endsection
