@extends('master.admin-master.master')
@section('title')
    Add Banner
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
                <form action="{{ !empty($bannerData) ? route('add-edit-banner', ['id' => $bannerData->id]) : route('add-edit-banner') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-header">
                        <h4>{{ $title }}</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="">Banner Image</label>
                            <input type="file" name="image" class="form-control-file">
                            @if (!empty($bannerData->image))
                                <img src="{{ asset($bannerData->image) }}" alt="" height="120" width="120">
                                <div>
                                    <a target="_blank" href="{{ asset($bannerData->image) }}">View Image</a>
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="">Title</label>
                            <input type="text" name="title" value="{{ !empty($bannerData) ? $bannerData->title : old('title') }}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">link</label>
                            <input type="text" name="link" value="{{ !empty($bannerData) ? $bannerData->link : old('link') }}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Alt</label>
                            <input type="text" name="alt" value="{{ !empty($bannerData) ? $bannerData->alt : old('alt') }}" class="form-control">
                        </div>
                    </div>
                    <div class="card-footer">
                        @if (!empty($bannerData))
                        <button class="btn btn-success" type="submit">Update Banner</button>
                        @else
                        <button class="btn btn-success" type="submit">Save Banner</button>
                        @endif
                    </div>
                </form>
                </div>
            </div>
            </div>
        </div>
    </div>
@endsection
