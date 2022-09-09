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
            <li class="breadcrumb-item active">Update Admin Details</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>


  <div class="container">
    <div class="row">
        <div class="col-md-6 " style="padding-left: 50px;">
            <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Update Details</h3>
                </div>
                @if (Session::has('message'))
                <div class="alert alert-success alert-dismissible fade show mt-2" role="alert" >
                    <h4 class="text-center">{{ Session::get('message') }}</h4>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                @endif
                <!-- /.card-header -->
                <!-- form start -->
                <form action="{{ route('admin-update-details') }}" method="POST" enctype="multipart/form-data" style="padding: 20px;">
                   @csrf
                    <div class="form-group">
                      <label for="exampleInputEmail1">Email address</label>
                      <input type="email" class="form-control" value="{{ Auth::guard('admin')->user()->email }}" id="exampleInputEmail1" placeholder="Enter email" readonly>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Admin Type</label>
                      <input type="text"  class="form-control" value="{{ Auth::guard('admin')->user()->type }}" id="exampleInputEmail1" placeholder="Admin Type" readonly>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Name</label>
                      <input type="text" name="name" value="{{ Auth::guard('admin')->user()->name }}" class="form-control" id="admin_name" placeholder="Enter Name">
                      <span id="msg"></span>
                      <span class="text-danger">@error('name')
                            {{ $message }}
                      @enderror</span>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Mobile</label>
                      <input type="text" name="phone" value="{{ Auth::guard('admin')->user()->phone }}" class="form-control" id="phone" placeholder="Enter Mobile">
                      <span class="text-danger">@error('phone')
                        {{ $message }}
                     @enderror</span>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Image</label>
                      <input type="file" name="image" class="form-contro-file" id="admin_image">
                      @if (!empty(Auth::guard('admin')->user()->image))
                         <img src="{{ asset(Auth::guard('admin')->user()->image) }}" alt="" height="60" width="60"><br>
                         <a target="_blank" href="{{ asset(Auth::guard('admin')->user()->image) }}">View Image</a>
                      @endif
                      <span class="text-danger">@error('image')
                        {{ $message }}
                     @enderror</span>
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

