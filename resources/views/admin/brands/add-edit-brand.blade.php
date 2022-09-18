@extends('master.admin-master.master')
@section('title')
    Add Brand
@endsection

@section('body')
    <div class="content">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
              <div class="row mb-2">
                <div class="col-md-12">
                 <h1>{{ $title }}</h1>
                </div>
                <div class="col-md-12">
                  <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin-dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">{{ $title }}</li>
                  </ol>
                </div>
              </div>
            </div><!-- /.container-fluid -->
          </section>
        <div class="container">
            <div class="row">
            <div class="col-md-6 mx-auto">
                @if (Session::has('message'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <h4>{{ Session::get('message') }}</h4>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                @endif
                @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                @endif
                <div class="card ">
                <form action="{{ !empty($brandData) ? route('add-edit-brand', ['id' => $brandData->id]) : route('add-edit-brand') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-header">
                        <h4>{{ $title }}</h4>
                    </div>
                    <div class="card-body">
                            <div class="form-group">
                                <label for="">Brand Name</label>
                                <input type="text" value="{{ !empty($brandData) ? $brandData->brand_name : old('brand_name') }}" name="brand_name" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Brand Image</label>
                                <input type="file" name="brand_image" class="form-control-file">
                            </div>
                    </div>
                    <div class="card-footer">
                        <button class="btn btn-success" type="submit">Save Brand</button>
                    </div>
                </form>
                </div>
            </div>
            </div>
        </div>
    </div>
@endsection
