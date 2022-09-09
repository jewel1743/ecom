@extends('master.admin-master.master')

@section('title')
    Settings
@endsection

@section('body')
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Dashboard</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Settings</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>


  <div class="container">
    <div class="row">
        <div class="col-md-6 " style="padding-left: 60px;">
            <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Update Passwords</h3>
                </div>
                @if (Session::has('message'))
                <div class="alert alert-danger alert-dismissible fade show mt-2" role="alert" >
                    <h4 class="text-center">{{ Session::get('message') }}</h4>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                @endif

                @if (Session::has('success'))
                <div class="alert alert-success alert-dismissible fade show mt-2" role="alert" >
                    <h4 class="text-center">{{ Session::get('success') }}</h4>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                @endif

                <!-- /.card-header -->
                <!-- form start -->
                <form action="{{ route('admin-update-password') }}" method="POST" style="padding: 20px;">
                   @csrf
                    <div class="form-group">
                      <label for="exampleInputEmail1">Email address</label>
                      <input type="email" class="form-control" value="{{ $admin->email }}" id="exampleInputEmail1" placeholder="Enter email" readonly>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Admin Type</label>
                      <input type="text"  class="form-control" value="{{ $admin->type }}" id="exampleInputEmail1" placeholder="Admin Type" readonly>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Current Password</label>
                      <input type="password" name="current_password" class="form-control" id="current_pwd" placeholder="Enter Current Password">
                      <span id="msg"></span>
                      <span class="text-danger">@error('current_password')
                            {{ $message }}
                      @enderror</span>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">New Password</label>
                      <input type="password" name="new_password" class="form-control" id="new_pwd" placeholder="Enter New Password">
                      <span class="text-danger">@error('new_password')
                        {{ $message }}
                     @enderror</span>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Confirm Password</label>
                      <input type="password" name="confirm_password" class="form-control" id="confirm_pwd" placeholder="Confirm Password">
                      <span class="text-danger">@error('confirm_password')
                        {{ $message }}
                     @enderror</span>
                    </div>
                    <div class="form-check">
                      <input type="checkbox" class="form-check-input" id="">
                      <label class="form-check-label" for="exampleCheck1">Check me out</label>
                    </div>
                  </div>
                  <!-- /.card-body -->

                  <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Update</button>
                  </div>
                </form>
              </div>
        </div>
    </div>
  </div>
@endsection
@section('admin-js')
  <script>
        $(document).ready(function(){
            $('#current_pwd').keyup(function(){
                var currentPwd= $(this).val();
                var baseUrl = '{{ url('/') }}';
                $.ajax({
                    type: 'post',
                    url: baseUrl+'/admin/check-current-password',
                    data: {currentPwd:currentPwd},
                    success:function(res){
                        if(res == 'true'){
                            $('#msg').html('<font color=blue>Current Password is Correct</font>');
                        }
                        else if(res == 'false'){
                            $('#msg').html('<font color=red>Current Password is Incorrect</font>');
                        }
                    },
                    error:function(error){
                        console.log(error);
                    }
                });
            });
        });
  </script>
@endsection
